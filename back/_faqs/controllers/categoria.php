<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Categoria extends Back_Controller {

    protected $admin_area = true;

    public function __construct() {
        parent::__construct();
    }

    // ----------------------------------------------------------------------

    public function index() {       
        $categoria = new Categoria_faq;
        $categoria->get();
        
        $save_url = cms_url('faqs/categoria/save');

        $this->_data['save_url'] = $save_url;

        $this->_data['datos'] = $categoria;
        

        $this->_data['edit_url'] = cms_url('faqs/categoria/editar/%d/');


        return $this->build('categoria/body');
    }

    // ----------------------------------------------------------------------

    public function editar($id = null) {
        $datos = new Categoria_faq($id);

        if (empty($id) OR !$datos->exists()) {
            return show_404();
        }

        $save_url = cms_url('faqs/categoria/save/' . $id);
        $this->_data['save_url'] = $save_url;
        
        return $this->set_datos($datos)->build('categoria/editar');
    }

    // ----------------------------------------------------------------------

    public function save($id = null) {
        $datos = new Categoria_faq($id);

        $datos->var = seo_name($this->_post('name'));

        $ok = $datos->from_array($this->_post(null), null, true);



        if (!$ok) {
            $this->set_message($datos->error->string);
        } else {
            $this->set_message('Guardado exitosamente...');
        }

        // Titulo de la alerta de error
        $this->_data['title_error'] = 'Error al guardar datos';

        // URL de continuación del formulario
        $this->_data['continue_url'] = cms_url('faqs/categoria');

        // ID del nuevo elemento (si llega a guardar)
        $this->_data['id'] = $datos->id;

        return $this->render_json($ok);
    }

    // ----------------------------------------------------------------------
}