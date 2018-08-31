<?php

class Review extends AppModel
{
    public $validate = [
        'name' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Name is required'
            ]],
			 'rating' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Rating is required'
            ]],
			 'review' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Review is required'
            ]],
		        'email' => [
			'required' => [
                'rule' => ['notBlank'],
                'message' => 'Email is required'
            ],
            'duplicate1' => [
                'rule' => 'email',
                'message' => 'Please enter valid email.'
            ]
        ],
        
    ];

   
}
