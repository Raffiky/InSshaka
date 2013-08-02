<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Faqs extends Front_Controller {

  public function __construct() {
    parent::__construct();
    $this->_datos = new Faq();
  }

  // ----------------------------------------------------------------------

  public function index() {
    $cat_faq = new Categoria_faq;
    $this->_data['categoria'] = $cat_faq->get();
    
    $this->_datos->where('activo', true);
    $this->_datos->order_by('id_categoria_faq', 'ASC');
    $this->_data['faqs'] = $this->_datos->get();

    return $this->build();
  }
  // ----------------------------------------------------------------------
  
  public function save_question() {
    $this->_datos->titulo_faq = $this->_post('pregunta');
    $this->_datos->respuesta_faq = 'Sin respuesta';
    $this->_datos->activo = 0;
    $this->_datos->id_categoria_faq = 1;
    
    $this->_datos->save();
    
    if ($this->_datos->save()) {
      $this->set_alert('Pregunta guardada exitosamente!');
    } else {
      $this->set_alert($this->_datos->errors->string);
    }
    
    $this->index();
  }
  // ----------------------------------------------------------------------
  
}