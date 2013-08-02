<?php

class Notification extends DataMapper {

    public $model = 'notification';
    public $table = 'notifications';
    public $has_one = array(
        'user' => array(
            'auto_populate' => true
        ),
        'intelligence' => array(
            'auto_populate' => true
        )
    );
    public $has_many = array();
    public $default_order_by = array('update_on' => 'DESC');
    public $validation = array();

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------

   
}