<?php

/**
 * @author rigobcastro
 */
class Publicity extends Back_Controller {

    protected $admin_area = true;

    public function __construct() {
        parent::__construct();
    }

    // ----------------------------------------------------------------------

    public function index() {
      $datos = new Publicity_banner();
      $datos->get();

      $this->set_datos($datos);

      // URL para editar
      $this->_data['delete_url'] = cms_url('banners/publicity/delete/%d/');
      $this->_data['save_url'] = cms_url('banners/publicity/save');
      $this->_data['upload_url'] = cms_url('banners/upload');

      return $this->build('publicity/body');
    }

    // ----------------------------------------------------------------------



    public function save() {
        $datos = new Publicity_banner;

        foreach ($this->_post('images') as $image) {

            if (!empty($image['image']) && !empty($image['thumb'])) {

                $datos->image = $image['image'];
                $datos->thumb = $image['thumb'];
                $datos->title = $this->_post('titulo');
                $datos->url = $this->_post('url');
                
                $datos->save_as_new();
                $datos->clear();
            }
        }

        return redirect('cms/banners/publicity');
    }

    // ----------------------------------------------------------------------

    

    public function save_tamano() {
        $subtema_item_id = $this->_get('subtema_item_id');
        $tamano_id = $this->_get('tamano_id');

        $subtema = new Album_subtemas_item($subtema_item_id);
        $tamano = new Album_tamano($tamano_id);

        $ok = $subtema->save($tamano);

        return $this->render_json($ok);
    }

    // ----------------------------------------------------------------------
}