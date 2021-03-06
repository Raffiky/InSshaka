<?php

class Users_show extends DataMapper {

    public $model = 'users_show';
    public $table = 'users_shows';
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
    public $validation = array(
        'date' => array(
            'label' => 'Fecha y hora del show',
            'rules' => array('required')
        ),
        'city' => array(
            'label' => 'Ciudad',
            'rules' => array('required')
        ),
        'place' => array(
            'label' => 'Lugar',
            'rules' => array('required')
        ),
        'adress' => array(
            'label' => 'Direccion',
            'rules' => array('required')
        )
    );
    
    public $default_order_by = array('date' => 'DESC');

    // ----------------------------------------------------------------------

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------
}