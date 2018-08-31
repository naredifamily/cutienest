<?php

class State extends AppModel
{
    public $validate = [
        'name' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Name is required'
            ]
        ],
        
    ];

   
}
