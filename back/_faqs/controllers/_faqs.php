<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class _Faqs extends Back_Controller {

    protected $admin_area = true;

    public function __construct() {
        parent::__construct();
    }

    // ----------------------------------------------------------------------

    public function index() {
        $datos = new Faq();
        $datos->get();
        
        $categoria = new Categoria_faq;
        $categoria->get();
        
        $__cat = clone $categoria;
        
        $save_url = cms_url('faqs/save');

        $this->_data['save_url'] = $save_url;

        $this->_data['datos'] = $datos;
        
        $this->_data['categoria'] = $categoria->get_for_select("Seleccione...");
        $this->_data["cat"] = $__cat;

        $this->_data['edit_url'] = cms_url('faqs/editar/%d/');


        return $this->build('body');
    }

    // ----------------------------------------------------------------------

    public function editar($id = null) {
        $datos = new Faq($id);
        $categoria = new Categoria_faq;
        $categoria->get();

        if (empty($id) OR !$datos->exists()) {
            return show_404();
        }

        $save_url = cms_url('faqs/save/' . $id);
        $this->_data['save_url'] = $save_url;
        $this->_data['categoria'] = $categoria->get_for_select("Seleccione...");
        
        return $this->set_datos($datos)->build('editar');
    }

    // ----------------------------------------------------------------------

    public function save($id = null) {
        $datos = new Faq($id);

        $datos->var = seo_name($this->_post('name'));

        $datos->from_array($this->_post(null));
        $datos->created_on = datetime_now();
        
        $ok = $datos->save();


        if (!$ok) {
            $this->set_message($datos->error->string);
        } else {
            $this->set_message('Guardado exitosamente...');
        }

        // Titulo de la alerta de error
        $this->_data['title_error'] = 'Error al guardar datos';

        // URL de continuación del formulario
        $this->_data['continue_url'] = cms_url('faqs');

        // ID del nuevo elemento (si llega a guardar)
        $this->_data['id'] = $datos->id;

        return $this->render_json($ok);
    }

    // ----------------------------------------------------------------------
}