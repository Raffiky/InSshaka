<?php

class Users_clasificado extends DataMapper {

    public $model = 'users_clasificado';
    public $table = 'users_clasificados';
    public $has_one = array();
    public $has_many = array();
    public $validation = array();
    

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------
    
    public function get_favorite($id = NULL) {
      $user = new \User;
      $user->get_current();
      
      $favorito = clone $this;
      $favorito->where('user_id', $user->id);
      $favorito->where('clasificados_id', $id);
      $favorito->get();
      
      return $favorito;
    }
    
    // ----------------------------------------------------------------------
    
    public function get_clasificado($id = NULL) {
      $clasificado = new Clasificado;
      $clasificado->get_by_id($id);
      
      return $clasificado;
    }

    // ----------------------------------------------------------------------
    
}