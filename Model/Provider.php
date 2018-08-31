<?php
App::uses('AuthComponent', 'Controller/Component');
 
class Provider extends AppModel {
    public $super_admin_role = 0;
	public $provider_role = 1;
    public $user_role = 2;
    public $avatarUploadDir = 'img/avatars';
      	
	 public $hasMany = array(
        'Pricelist' => array(
            'className' => 'Pricelist',
        ),
		 'SocialProfile' => array(
        'className' => 'SocialProfile',
    )
    );
	
	


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
		'password' => [
                        [
                                'rule' => ['notBlank'],
                                'message' => 'Please Enter password'
                       ],
                       [                              
                         'rule' => ['minLength', 6],
                         'message' => 'Passwords must be at least 6 characters long.',
                      ]
                ],
		'password_confirm'=>[
              'rule' => ['equalToField', 'password'],
                'message'=>'Password Confirmation must match Password',                         
           ],   
			
        'email' => [
            'duplicate' => [
                'rule' => 'isUnique',
                'on' => 'create',
                'message' => 'An account with this email address already exists. Please log in to countinue.'
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
            ]//,
            /*'numeric' => [
                'rule' => 'numeric',
                'message' => 'Please enter numbers only'
            ]*/
        ],
    ];
     
        /**
     * Before isUniqueUsername
     * @param array $options
     * @return boolean
     */
    function isUniqueUsername($check) {
 
        $username = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.id',
                    'User.username'
                ),
                'conditions' => array(
                    'User.username' => $check['username']
                )
            )
        );
 
        if(!empty($username)){
            if($this->data[$this->alias]['id'] == $username['User']['id']){
                return true; 
            }else{
                return false; 
            }
        }else{
            return true; 
        }
    }
 
    /**
     * Before isUniqueEmail
     * @param array $options
     * @return boolean
     */
    function isUniqueEmail($check) {
 
        $email = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.id'
                ),
                'conditions' => array(
                    'User.email' => $check['email']
                )
            )
        );
 
        if(!empty($email)){
            if($this->data[$this->alias]['id'] == $email['User']['id']){
                return true; 
            }else{
                return false; 
            }
        }else{
            return true; 
        }
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
	
	public function getRole()
    {
        App::import('component', 'CakeSession');
        $role = CakeSession::read('Auth.User.role');

        return $role;
    }

    public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];
 
        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }
     
    public function equaltofield($check,$otherfield) 
    { 
        //get name of field 
        $fname = ''; 
        foreach ($check as $key => $value){ 
            $fname = $key; 
            break; 
        } 
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname]; 
    } 
	 public function createFromSocialProfile($incomingProfile){
	
			// check to ensure that we are not using an email that already exists
			$existingUser = $this->find('first', array(
				'conditions' => array('email' => $incomingProfile['SocialProfile']['email'])));
	
			if($existingUser){
				// this email address is already associated to a member
				return $existingUser;
			}
	
			// brand new user
			$socialUser['User']['email'] = $incomingProfile['SocialProfile']['email'];
			$socialUser['User']['username'] = str_replace(' ', '_',$incomingProfile['SocialProfile']['display_name']);
			$socialUser['User']['role'] = '2'; // by default all social logins will have a role of bishop
			$socialUser['User']['status'] = '1'; // by default all social logins will have a status on
			$socialUser['User']['password'] = date('Y-m-d h:i:s'); // although it technically means nothing, we still need a password for social. setting it to something random like the current time..
			//$socialUser['User']['created'] = date('Y-m-d h:i:s');
			//$socialUser['User']['modified'] = date('Y-m-d h:i:s');
	
			// save and store our ID
			$this->save($socialUser);
			$socialUser['User']['id'] = $this->id;
	
			return $socialUser;
	
	
		}
	 
 
    /**
     * Before Save
     * @param array $options
     * @return boolean
     */
     public function beforeSave($options = array()) {
        // hash our password
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
         
        // if we get a new password, hash it
        if (isset($this->data[$this->alias]['password_update']) && !empty($this->data[$this->alias]['password_update'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
        }
     
        // fallback to our parent
        return parent::beforeSave($options);
    }
 
}
