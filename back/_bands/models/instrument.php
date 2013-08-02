<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Instrument extends DataMapper {

    public $model = 'instrument';
    public $table = 'instruments';
    public $has_one = array();
    public $has_many = array(
        'bands_instrument' 
    );
    public $validation = array(
        'name' => array(
            'label' => 'Nombre',
            'rules' => array('required', 'unique')
        )
    );

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------
    
    public function get_for_select($text = 'Instrumento') {
        $return = array(0 => $text);
        
        $datos = clone $this;
        
        $datos->get();
        
        foreach($datos->all as $instrumento){
            $return[$instrumento->id] = $instrumento->name;
        }
        
        return $return;
    }
    
    // ----------------------------------------------------------------------
}