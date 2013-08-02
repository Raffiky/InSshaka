<?php

class Pages_song extends DataMapper {

    public $model = 'pages_song';
    public $table = 'pages_songs';
    public $has_one = array(
        'page' => array(
            'auto_populate' => true
        )
    );
    public $has_many = array();
    public $validation = array(
        'url' => array(
            'label' => 'URL de la canción',
            'rules' => array('required', 'valid_url')
        )
    );

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------

    public function get_songs_urls() {
        if (!$this->exists()) {
            return false;
        }
        $return = array();

        foreach ($this as $dato) {
            array_push($return, $dato->url);
        }

        return $return;
    }

    // ----------------------------------------------------------------------
}