<?php
App::uses('AuthComponent', 'Controller/Component');
 
class Feedback extends AppModel {
    
    public $validate = [
        'username' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Name is required'
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
        'useremail' => [
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
        'userphone' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Phone No is required'
            ]//,
            /*'numeric' => [
                'rule' => 'numeric',
                'message' => 'Please enter numbers only'
            ]*/
        ],
		'usermessage' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Message is required'
            ]//,
            /*'numeric' => [
                'rule' => 'numeric',
                'message' => 'Please enter numbers only'
            ]*/
        ],
    ];
     
     
 
}
