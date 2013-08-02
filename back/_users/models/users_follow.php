<?php

class Users_follow extends DataMapper {

    public $model = 'users_follow';
    public $table = 'users_follows';
    public $has_one = array(
        'user' => array(
            'auto_populate' => true
        )
    );
    public $has_many = array(
        'intelligence' => array(
            'auto_populate' => true
        )
    );
    public $validation = array();

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------

   
}