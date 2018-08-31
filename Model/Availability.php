<?php

class Availability extends AppModel
{
    public $validate = [
        'agegroup' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Age Group is required'
            ]],
		'from' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'From date required'
            ]],
		'to' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'To date required'
            ]
        ],
        
    ];

   
}
