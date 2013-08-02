<?php

class Intelligences_comment extends DataMapper {

    public $model = 'intelligences_comment';
    public $table = 'intelligences_comments';
    public $has_one = array(
        'user' => array(
            'auto_populate' => true
        ),
        'intelligence' => array(
            'auto_populate' => true
        )
    );
    public $has_many = array();
    public $default_order_by = array('created_on' => 'DESC');
    public $validation = array();

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------

   
}