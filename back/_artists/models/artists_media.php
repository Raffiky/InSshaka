<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Artists_media extends DataMapper {

    public $model = 'artists_media';
    public $table = 'artists_medias';
    public $has_one = array(
        'artist' => array(
            'auto_populate' => true
        ),
        'media_categoria' => array(
            'auto_populate' => true
        )
    );
    public $has_many = array();
    public $validation = array(
        'artist_id' => array(
            'label' => 'Artista',
            'rules' => array('required_select')
        ),
        'media_categoria_id' => array(
            'label' => 'Categoria',
            'rules' => array('required_select')
        )
    );
    
    public $default_order_by = array('created_on' => 'DESC');

    public function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    // ----------------------------------------------------------------------
    
    public function get_oembed() {
        if ($this->exists()) {
            
            $url = $this->url;
            $return = null;

            $url_get = 'http://vimeo.com/api/oembed.json?url=%s';

            if (is_youtube_url($url)) {
                $url_get = 'http://www.youtube.com/oembed?url=%s&format=json';
            }

            $this->oembed = json_decode(file_get_contents(sprintf($url_get, rawurlencode($url))));
        }

        $html = $this->oembed->html;
        $doc = new DOMDocument();
        @$doc->loadHTML($html);

        $embeds = $doc->getElementsByTagName('iframe');

        foreach ($embeds as $embed) {
            $this->oembed->url = $embed->getAttribute('src');
        }
        

        return $this;
    }

    // ----------------------------------------------------------------------
    
    public function create_code($length = 6) {
        $datos = clone $this;

        $code = random_string('md5', $length);

        $datos->get_by_code($code);

        if ($datos->exists()) {
            return create_code($length);
        }

        return $code;
    }

    // ----------------------------------------------------------------------

}