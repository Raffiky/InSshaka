<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Noticias extends Front_Controller {
    
     protected $user_area = true;

    public function __construct() {
        parent::__construct();
        
        $this->load->model(array('_news/news', '_news/news_image'));
        $this->_datos = new News;
    }

    // ----------------------------------------------------------------------
    
    public function index() {
      
      $this->_data['news'] = $this->_datos->get_news(0,3);
      $this->_data['list_news'] = $this->_datos->get_news(3,1000);     
      $this->set_title('Noticias');
      
      return $this->build();
    }

    // ----------------------------------------------------------------------

    public function ver($var = NULL) {
        
        $this->_data['news'] = $this->_datos->get_by_var(str_replace('_','-',$var));
        $this->_data['list_news'] = $this->_datos->get_news(0,1000);
        $titulo = $this->_datos->title;
        $this->set_title('Noticia: ' . $titulo);
        
        return $this->build('detalle');
    }

    // ----------------------------------------------------------------------
    
    
  
}
?>