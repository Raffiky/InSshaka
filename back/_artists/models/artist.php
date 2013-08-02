<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Artist extends DataMapper {

    public $model = 'artist';
    public $table = 'artists';
    public $has_one = array(
        'musical_gender' => array(
            'auto_populate' => true
        )
    );
    public $has_many = array(
        'artists_media' => array(
            'auto_populate' => true
        )
    );
    public $validation = array(
        'name' => array(
            'label' => 'Nombre',
            'rules' => array('required')
        ),
        'musical_gender_id' => array(
            'label' => 'Género músical',
            'rules' => array('required_select')
        ),
        'image' => array(
            'label' => 'Imágen',
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
        
        foreach($datos->all as $artista){
            $return[$artista->id] = $artista->name;
        }
        
        return $return;
    }
    
    // ----------------------------------------------------------------------

}