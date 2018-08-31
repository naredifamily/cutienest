<?php

class Admissionpack extends AppModel
{
    public $validate = [
        'file' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'File Required'
            ]
        ],
        
    ];


}
