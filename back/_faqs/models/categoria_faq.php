<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Categoria_faq extends DataMapper {

    public $model = 'categoria_faq';
    public $table = 'categoria_faqs';
    
    public $has_one = array();
    public $has_many = array(
        'faq' => array(
            'auto_populate' => true
        )
    );
    
    public $validation = array(
        'categoria_faq' => array(
            'label' => 'Categoria',
            'rules' => array('required','unique')
        )
    );
    
    public $default_order_by = array('id' => 'ASC');

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------
    
    public function get_cat_faq($id = NULL) {
      $datos = clone $this;
      $datos->get_by_id($id);
      
      return $datos->categoria_faq;
    }
}