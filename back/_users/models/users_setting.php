<?php
/**
 * Modelo de Herramientas de usuario
 *
 * @author Cristian Rivas
 */
class Users_Setting extends DataMapper {
  
  public $model = 'users_setting';
  public $table = 'users_settings';
  public $has_one = array(
      'user' => array(
          'auto_populate' => true
      )
  );
  public $has_many = array();
  public $validation = array();

  // ----------------------------------------------------------------------

  public function __construct($id = NULL) {
      parent::__construct($id);
  }

  // ----------------------------------------------------------------------
}

