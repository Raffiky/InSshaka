<?php

class Intelligence extends DataMapper {

    public $model = 'intelligence';
    public $table = 'intelligences';
    public $has_one = array(
        'user' => array(
            'auto_populate' => true
        ),
        'users_follow' => array(
            'auto_populate' => true
        ),
        'audicion' => array(
            'auto_populate' => true
        ),
        'clasificado' => array(
            'auto_populate' => true
        ),
        'band' => array(
            'auto_populate' => true
        ),
        'statu' => array(
            'auto_populate' => true
        ),
        'audiciones_aplicacion' => array(
            'auto_populate' => true
        ),
        'users_show' => array(
            'auto_populate' => true
        ),
        'users_photo' => array(
            'auto_populate' => true
        )
    );
    public $has_many = array(
        'intelligences_comment' => array(
            'auto_populate' => true
        ),
        'notification' => array(
            'auto_populate' => true
        )
    );
    public $default_order_by = array('id' => 'DESC');
    public $validation = array();

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------

   
}