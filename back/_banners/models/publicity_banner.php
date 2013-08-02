<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Publicity_banner extends DataMapper {

    public $model = 'publicity_banner';
    public $table = 'publicity_banners';

    public $has_one = array();
    public $has_many = array();
    
    public $validation = array(
        'image' => array(
            'label' => 'Imagen',
            'rules' => array('required')
        )
    );
    
    // ----------------------------------------------------------------------

    public function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    // ----------------------------------------------------------------------
}