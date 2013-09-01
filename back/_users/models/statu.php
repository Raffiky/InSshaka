<?php

class Statu extends DataMapper {

    public $model = 'statu';
    public $table = 'status';
    public $has_one = array(
        'user' => array(
            'auto_populate' => true
        )
    );
    public $has_many = array(
        'intelligence' => array(
            'auto_populate' => true
        )
    );
    public $validation = array();
    
    // ----------------------------------------------------------------------

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------
    
    public function get_oembed() {
        if ($this->exists()) {
            
            $url = $this->status;
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
            $this->oembed->status = $embed->getAttribute('src');
        }
        

        return $this;
    }

    // ----------------------------------------------------------------------
}