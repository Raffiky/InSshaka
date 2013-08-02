<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Media_categoria extends DataMapper {

    public $model = 'media_categoria';
    public $table = 'media_categorias';
    public $has_one = array();
    public $has_many = array(
        'artists_media' => array(
            'auto_populate' => true
        )
    );
    public $validation = array(
        'name' => array(
            'label' => 'Nombre',
            'rules' => array('required')
        )
    );
    
    public $default_order_by = array('name' => 'ASC');

    public function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    // ----------------------------------------------------------------------
    
    public function get_for_select($text = 'Seleccione...') {
        $return = array(0 => $text);
        
        $datos = clone $this;
        
        $datos->get();
        
        foreach($datos->all as $genero){
            $return[$genero->id] = $genero->name;
        }
        
        return $return;
    }

    // ----------------------------------------------------------------------

}