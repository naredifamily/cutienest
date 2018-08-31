<?php

class Invoice extends AppModel
{
    public $validate = [
        'user' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'User is required'
            ]],
			 'amount' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Amount is required'
            ]],
			 
    ];

   
}
