<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{
public function beforeSave($options = array()) {
        // hash our password
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
         
        // if we get a new password, hash it
        if (isset($this->data[$this->alias]['password_update']) &amp;&amp; !empty($this->data[$this->alias]['password_update'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
        }
     
        // fallback to our parent
        return parent::beforeSave($options);
    }
 

    public $super_admin_role = 0;
    public $user_role = 1;

    public $validate = [
        'name' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Name is required'
            ]
        ],
		 'state' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'State is required'
            ]
        ],
        'email' => [
            'duplicate' => [
                'rule' => 'isUnique',
                'on' => 'create',
                'message' => 'This email is already exist.'
            ],
			'required' => [
                'rule' => ['notBlank'],
                'message' => 'Email is required'
            ],
            'duplicate1' => [
                'rule' => 'email',
                'message' => 'Please enter valid email.'
            ]
        ],
            'address' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Address is required'
            ]
        ],
        'phone' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Phone No is required'
            ],
            'numeric' => [
                'rule' => 'numeric',
                'message' => 'Please enter numbers only'
            ]
        ],
    ];

    public function getRole()
    {
        App::import('component', 'CakeSession');
        $role = CakeSession::read('Auth.User.role');

        return $role;
    }

    public function allowAccess($allowed = [0])
    {
        App::import('component', 'CakeSession');
        $role = CakeSession::read('Auth.User.role');

        if (!in_array($role, $allowed)) {
            return false;
        }

        return true;
    }

    public function allowAccessExcept($restricted = [0])
    {
        App::import('component', 'CakeSession');
        $role = CakeSession::read('Auth.User.role');

        if (in_array($role, $restricted)) {
            return false;
        }

        return true;
    }

    /**
     * Returns true if current user is not super admin
     *
     * @return bool
     */
    public function isNotSuperAdmin()
    {
        $role = $this->getRole();

        if ($role != $this->super_admin_role) {
            return true;
        }

        return false;
    }

    /**
     * Returns true if current user is a normal user
     *
     * @return bool
     */
    public function isUser()
    {
        $role = $this->getRole();

        if ($role == $this->user_role) {
            return true;
        }

        return false;
    }


}
