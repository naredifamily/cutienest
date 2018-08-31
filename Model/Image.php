<?php

class Image extends AppModel
{
    public $validate = [
        'path' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Select Image'
            ]
        ],
        
    ];

   
}
