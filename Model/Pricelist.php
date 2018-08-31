<?php

class Pricelist extends AppModel
{
    public $validate = [
        'agegroup' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Age Group is required'
            ]],
		'timeslot' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Time Slot is required'
            ]],
		'amount' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Price is required'
            ]
        ],
        
    ];

   
}
