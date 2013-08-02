<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * @author Cristian Rivas
 */
class Conciertos extends Front_Controller  {
  
  protected $user_area = true;
  private $_datos = null;
  private $_count = 0;
  
  public function __construct() {
    parent::__construct();
    
    $this->_datos = new Calendar;
  }
  
  // ----------------------------------------------------------------------
  
  public function index(){
    $this->set_title('Conciertos');
    $datos = $this->_datos->get();
    
    $this->set_datos($datos);

    return $this->build();
  }
  
  // ----------------------------------------------------------------------
}