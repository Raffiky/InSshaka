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
    $this->set_title("Mensaje enviado satisfactoriamente!!");
    if($this->is_usuario()){
      $this->load->model("_users/user");
      $user = new \User;
      $user->get_current();
      $this->_datos->user_id = $user->id;
    }  else {
      $this->_datos->full_name = $this->_post("full_name");
      $this->_datos->email  = $this->_post("email");
      $this->_datos->user_id = 0;
    }
    $this->_datos->titulo_faq = $this->_post('pregunta');
    $this->_datos->respuesta_faq = 'Sin respuesta';
    $this->_datos->activo = 0;
    $this->_datos->id_categoria_faq = 1;
    $this->_datos->created_on = datetime_now();
    
    
    $this->_datos->save();
    
    if ($this->_datos->save()) {
      $this->load->library('email');
      $this->email->clear();
      
      if($this->is_usuario()){
        $usuario = $this->_datos->user->first_name." ".$this->_datos->user->last_name;
        $email = $this->_datos->user->email;
      }else{
        $usuario = $this->_post("full_name");
        $email = $this->_post("email");
      }
      
      $html = "<p>Nombre del usuario: $usuario </p>";
      $html .= "<p>Email: $email </p>";
      $html .= "<p>Su mensaje: <br><strong>\"". $this->_datos->titulo_faq ."\"</strong></p>";

      $this->email->from(SITEEMAIL, SITENAME);
      $this->email->to("rafael@inshaka.com, juanrnieto@gmail.com");
      $this->email->subject("Pregunta y/o sugerencia en la FAQ");
      $this->email->message($html);
      $this->email->send();
      
      $this->set_alert('Pregunta enviada exitosamente!', "success");
    } else {
      $this->set_alert($this->_datos->errors->string);
    }
    
    return $this->index();
  }
  // ----------------------------------------------------------------------
  
}