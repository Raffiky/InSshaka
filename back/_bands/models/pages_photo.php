<?php

class Pages_photo extends DataMapper {

    public $model = 'pages_photo';
    public $table = 'pages_photos';
    public $has_one = array(
        'page' => array(
            'auto_populate' => true
        )
    );
    public $has_many = array();
    public $validation = array(
        'image' => array(
            'label' => 'Image',
            'rules' => array('required')
        )
    );
    
    public $default_order_by = array('upload_on' => 'DESC');

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------
    
    public function get_photo($id = NULL) {
      $photo = clone $this;
      
      $photo->where('profile_active', true);
      $photo->get_by_page_id($id);
      
      return $photo->image;
    }
    
    // ----------------------------------------------------------------------

}