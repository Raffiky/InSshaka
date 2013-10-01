<?php

class Inbox extends DataMapper {

    public $model = 'inbox';
    public $table = 'inbox';
    public $has_one = array();
    public $has_many = array(
        'user' => array(
            'join_table' => 'users_inbox',
            'auto_populate' => true
        )
    );
    public $validation = array();
    public $default_order_by = array('created_on' => 'DESC');

    // ----------------------------------------------------------------------

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------
    
    public function get_oembed($req_url = null) {
        if ($this->exists()) {
            
            $url = $req_url;
            $return = null;
            $url_get = 'http://api.embed.ly/1/oembed?key=8cd3553a2bb8467fb13765b54347db62&url=%s&format=json';

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
    
}