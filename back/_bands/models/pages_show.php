<?php

class Pages_show extends DataMapper {

    public $model = 'pages_show';
    public $table = 'pages_shows';
    public $has_one = array(
        'page' => array(
            'auto_populate' => true
        )
    );
    public $has_many = array();
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
            'rules' => array('required', 'max_length' => 20)
        ),
        'address' => array(
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