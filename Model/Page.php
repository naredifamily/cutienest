<?php
App::uses('AuthComponent', 'Controller/Component');
 
class Page extends AppModel {
     
    public $avatarUploadDir = 'img/avatars';
     

    public $validate = [
        'title' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Title is required'
            ]
        ],
		 'slug' => [
            'duplicate' => [
                'rule' => 'isUnique',
                'on' => 'create',
                'message' => 'Slug already exist.'
            ],
			'required' => [
                'rule' => ['notBlank'],
                'message' => 'Slug is required'
            ],
            'duplicate1' => [
                'rule' => ['alphaNumericDashUnderscore'],
                'message' => 'Slug can only be letters, numbers, dash and underscore'
            ]
        ]
       
    ];
     
public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('|^[0-9a-zA-Z_-]*$|', $value);
    }  
 
}
