<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Audiciones_aplicacion extends DataMapper {

    public $model = 'audiciones_aplicacion';
    public $table = 'audiciones_aplicaciones';
    public $has_one = array(
        'audicion' => array(
            'auto_populate' => true
        )
    );
    public $has_many = array(
        'user' => array(
            'join_table' => 'users_audiciones_aplicaciones',
            'auto_populate' => true
        ),
        'intelligence' => array(
            'auto_populate' => true
        )
    );
    
    public $validation = array();

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------
    
    public function get_my_aplication ($user_id = NULL) {          
      $aplicacion = clone $this;
      $aplicacion->get_by_user_id($user_id);
      
      return $aplicacion;
    }
    
    // ----------------------------------------------------------------------
    
    public function get_aplications ($audicion_id = NULL) {
      $audicion = clone $this;
      $audicion->get_by_audicion_id($audicion_id);
      
      return $audicion;
    }
    
    // ---------------------------------------------------------------------- 
    
    public function get_user_aplication ($id = NULL) {
      $user = new User;
      $user->get_by_id($id);
      
      return $user;
    }
    // ---------------------------------------------------------------------- 
}