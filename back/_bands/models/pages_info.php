<?php

class Pages_info extends DataMapper {

    public $model = 'pages_info';
    public $table = 'pages_info';
    
    public $has_one = array(
        'page' => array(
            'auto_populate' => true
        )
    );
    public $has_many = array();
    
    public $validation = array(
        'sitio_web' => array(
            'label' => 'Sitio web',
            'rules' => array('valid_url')
        )
    );

    public function __construct($id = NULL) {
        parent::__construct($id);

    }

    // ----------------------------------------------------------------------

}