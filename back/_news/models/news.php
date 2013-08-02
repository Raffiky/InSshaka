<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class News extends DataMapper {

    public $model = 'news';
    public $table = 'news';

    public $has_one = array();
    
    public $has_many = array(
        'news_image' => array(
            'auto_populate' => true
        )
    );
    
    public $validation = array(
        'title' => array(
            'label' => 'Título',
            'rules' => array('required', 'unique')
        ),
        'content' => array(
            'label' => 'Contenido',
            'rules' => array('required')
        )
    );

    public function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    // ----------------------------------------------------------------------
    
    public function get_news ($ini = null, $end = null) {
      $news = clone $this;
      $news->limit($end,$ini);
      $news->order_by('created_on', 'DESC');     
      return $news->get();;
    }

    // ----------------------------------------------------------------------
}