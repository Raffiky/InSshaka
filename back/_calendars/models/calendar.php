<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Calendar extends DataMapper {

    public $model = 'calendar';
    public $table = 'calendars';
    public $has_one = array();
    public $has_many = array();
    public $validation = array();
    
    public $default_order_by = array('start' => 'DESC');

    public function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    // ----------------------------------------------------------------------
    

}