<?php

class Comment extends DataMapper {

    public $model = 'comment';
    public $table = 'comments';
    public $has_one = array();
    public $has_many = array(
        'user' => array(
            'join_table' => 'users_comments'
        ),
        'page' => array(
            'join_table' => 'pages_comments'
        )
    );
    public $validation = array(
        'comentario' => array(
            'label' => 'Comentario',
            'rules' => array('required', 'trim', 'xss_clean')
        ),
        'sonido' => array(
            'label' => 'Sonido',
            'rules' => array('required', 'is_numeric', 'intval')
        ),
        'presentacion' => array(
            'label' => 'Presentación',
            'rules' => array('required', 'is_numeric', 'intval')
        ),
        'profesionalismo' => array(
            'label' => 'Profesionalismo',
            'rules' => array('required', 'is_numeric', 'intval')
        ),
        'actitud' => array(
            'label' => 'Actitud',
            'rules' => array('required', 'is_numeric', 'intval')
        )
    );
    
    public $default_order_by = array('created_on' => 'DESC');

    // ----------------------------------------------------------------------

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------
    
    public function get_id_user_comment($id = NULL) {
      $user = new User;
      $user->get_by_id($id);
      return $user;
    }
    
    // ----------------------------------------------------------------------
    
    public function get_rating($id = NULL) {
      $comment = clone $this;
      $comment->select('( (AVG(`sonido`) +  AVG(`actitud`) +  AVG(`presentacion`) + AVG(`profesionalismo`) ) / 4) as "ratings"', true);
      $comment->get_by_id($id);
      
      $ratings = number_format($comment->ratings, 1);
      return $ratings;
    }
    
    // ----------------------------------------------------------------------
}