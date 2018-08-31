<?php



class Profileimage extends AppModel

{
		public $useTable = 'profileimages';
    public $validate = [
        'path' => [
            'required' => [
                'rule' => ['notBlank'],
                'message' => 'Select Image'
            ]
        ],
    ];
}