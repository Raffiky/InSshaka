<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Clasificado extends DataMapper {

    public $model = 'clasificado';
    public $table = 'clasificados';
    public $has_one = array(
        'user' => array(
            'auto_populate' => true
        ),
        'clasificados_categoria' => array(
            'auto_populate' => true
        )
    );
    public $has_many = array(
        'audiciones_aplicacion' => array(
            'auto_populate' => true
        ),
        'intelligence' => array(
            'auto_populate' => true
        ),
        'clasificados_aplicacion' => array(
            "auto_populate" => true
        )
    );
    public $validation = array(
        'titulo' => array(
            'label' => 'Título',
            'rules' => array('required')
        ),
        'ciudad' => array(
            'label' => 'Ciudad',
            'rules' => array('required')
        ),
        'fecha_cierre' => array(
            'label' => 'Fecha de cierre',
            'rules' => array('required')
        ),
        'precio' => array(
            'label' => 'Precio',
            'rules' => array('is_natural_no_zero')
        ),
        'clasificados_categoria_id' => array(
            'label' => 'Categoría',
            'rules' => array('required_select')
        ),
        'descripcion' => array(
            'label' => 'Descripción',
            'rules' => array('required', 'max_size' => 220)
        )
    );
    public $default_order_by = array('created_on' => 'DESC');

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------

    
    public function only_actives() {
        $this->where('fecha_cierre >', date('Y-m-d'));
        return $this;
    }

    // ----------------------------------------------------------------------
   
    public function get_only_actives() {
        $this->only_actives();
        $this->get();
        return $this;
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