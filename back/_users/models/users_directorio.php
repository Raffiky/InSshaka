<?php

class Users_directorio extends DataMapper {

    public $model = 'users_directorio';
    public $table = 'users_directorios';
    public $has_one = array(
        'user' => array(
            'auto_populate' => true
        ),
        'directorio' => array(
            'auto_populate' => true
        )
    );
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
      $favorito->where('directorio_id', $id);
      $favorito->get();
      
      return $favorito;
    }
    
    // ----------------------------------------------------------------------
}