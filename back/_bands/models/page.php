<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Page extends DataMapper {

    public $model = 'page';
    public $table = 'pages';

    public $has_one = array(
        'band' => array(
            'auto_populate' => true
        )
    );
    
    public $has_many = array(
        'comment' => array(
            'join_table' => 'pages_comments',
            'auto_populate' => true
        ),
        'pages_photo' => array(
            'auto_populate' => true
        ),
        'pages_info' => array(
            'auto_populate' => true
        ),
        'pages_video' => array(
            'auto_populate' => true
        ),
        'pages_song' => array(
            'auto_populate' => true
        ),
        'pages_show' => array(
            'auto_populate' => true
        )
    );
    
    public $validation = array();

    public function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    // ----------------------------------------------------------------------
    
    public function search_page($band_id = NULL){
      $this->get_by_band_id($band_id);
      if($this->exists()){
        return true;
      }else{
        return false;
      }      
    }
    
    // ----------------------------------------------------------------------

    public function get_rating() {
        if (!$this->exists()) {
            return false;
        }

        $comments = new \Comment;

        $comments
                ->select('( (AVG(`sonido`) +  AVG(`actitud`) +  AVG(`presentacion`) + AVG(`profesionalismo`) ) / 4) as "ratings"', true)
                ->get_by_related($this);


        $ratings = number_format($comments->ratings, 1);

        return $ratings;
    }

    // ----------------------------------------------------------------------
}