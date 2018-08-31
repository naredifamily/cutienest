<?php

class Search extends AppModel
{
    public $validate = [
        'zip' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Zip is required'
            ]
        ],
        
    ];


}
