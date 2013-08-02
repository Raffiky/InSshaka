<?php

class Statu extends DataMapper {

    public $model = 'statu';
    public $table = 'status';
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
    
    // ----------------------------------------------------------------------

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------
}