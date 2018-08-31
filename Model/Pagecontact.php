<?php
App::uses('AuthComponent', 'Controller/Component');
 
class Pagecontact extends AppModel {
public $useTable = false;
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Username is required'
            )
        ),
		'useremail' => array(
        'required' => array(
            'rule' => array('email'),
            'message' => 'Kindly provide valid email address'
        )
        
    	),
		'useraddress'=>array(
			'required' => array(
            	'rule' => array('notBlank'),
            	'message' => 'Kindly provide your address'
        	)
		),
		'userzip'=>array(
			'required' => array(
            	'rule' => array('notBlank'),
            	'message' => 'Kindly provide your zip code'
        	)
		),
		'userphone'=>array(
			'required' => array(
            	'rule' => array('notBlank'),
            	'message' => 'Kindly provide your phone number'
        	)
		),
		'usermessage'=>array(
			'required' => array(
            	'rule' => array('notBlank'),
            	'message' => 'Kindly provide your message'
        	)
		)
		
    );
}?>