<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Actions extends Front_Controller {

    protected $user_area = true;

    public function __construct() {
        parent::__construct();
    }

    // ----------------------------------------------------------------------

    public function add_users_image() {
        $datos = new Users_image;
        $user = new User;
        $user->get_current();

        if (!empty($_FILES['image']['name'])) {

            $path = UPLOADSFOLDER . $user->username . DS;

            if (!is_dir($path)) {
                @mkdir($path);
                @chmod($path, 0777);
            }

            $path .= 'users_images' . DS;

            if (!is_dir($path)) {
                @mkdir($path);
                @chmod($path, 0777);
            }


            $config['upload_path'] = $path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $message = $this->upload->display_errors();
            } else {


                // Limpiando el path del logo para guardarlo
                $datos_image = $this->upload->data();
                $path = str_replace(UPLOADSFOLDER, '', $datos_image['full_path']);

                $config['source_image'] = $datos_image['full_path'];
                $config['master_dim'] = 'height';
                $config['new_image'] = $datos_image['full_path'];
                $config['width'] = 185;
                $config['height'] = 185;

                $this->load->library('image_lib', $config);

                if (!$this->image_lib->resize()) {
                    $message = 'Hubo un error al remasterizar la imagen, verifica que tenga las medidas recomendadas.';
                } else {
                    $datos->image = $path;
                    $datos->name = $this->_post('name', true);
                    if ($datos->save($user)) {
                        $message = 'Imagen creada correctamente.';
                    } else {
                        $message = $datos->error->string;
                    }
                }
            }
        } else {
            $message = 'Debes seleccionar una imagen.';
        }

        $this->session->set_flashdata('message_add_users_image', $message);

        return redirect($this->_post('continue_url'), 'refresh');
    }

    // ----------------------------------------------------------------------

    public function add_users_video() {
        $datos = new Users_video;
        $user = new User;
        $user->get_current();

        $url = $this->_post('video_url');

        if (!is_youtube_url($url)) {
            if(!is_vimeo_url($url)){
                return show_error('El video tiene que ser de Youtube o VImeo');
            }
        } 

        $datos->url = $url;
        if(!$datos->save_as_new($user)){
            return show_error($datos->errors->string);
        }

         return redirect($this->_post('continue_url'));
    }

    // ----------------------------------------------------------------------
    
    public function remove_users_photo($id) {
        $datos = new Users_photo($id);
        
        if ($datos->exists()) {
            @unlink(UPLOADSFOLDER . $datos->image);
            @unlink(UPLOADSFOLDER . $datos->thumb);

            $delete = $this->db->where('id', $id)->delete('users_photos');

            if ($delete) {
               return redirect($this->_get('next'));
            }
        }
        
        return show_error('El recurso no está disponible, intente de nuevo más tarde.');
    }

    // ----------------------------------------------------------------------
    
    public function remove_users_video($id) {
        $delete = $this->db->where('id', $id)->delete('users_videos');
        
        if($delete){
            redirect($this->_get('next'));
        }
    }

    // ----------------------------------------------------------------------
    
    public function remove_pages_photo($id) {
        $datos = new Pages_photo($id);
        
        if ($datos->exists()) {
            @unlink(UPLOADSFOLDER . $datos->image);
            @unlink(UPLOADSFOLDER . $datos->thumb);

            $delete = $this->db->where('id', $id)->delete('pages_photos');

            if ($delete) {
               return redirect($this->_get('next'));
            }
        }
        
        return show_error('El recurso no está disponible, intente de nuevo más tarde.');
    }

    // ----------------------------------------------------------------------
    
    public function add_pages_video() {
      $this->load->model(array('_bands/pages_video'));
      $id = $this->_post('id');
      
      $datos = new Pages_video;
      $page = new Page;
      $page->get_by_id($id);

      $url = $this->_post('video_url');

      if (!is_youtube_url($url)) {
          if(!is_vimeo_url($url)){
              return show_error('El video tiene que ser de Youtube o VImeo');
          }
      } 

      $datos->url = $url;
      if(!$datos->save_as_new($page)){
          return show_error($datos->errors->string);
      }

       return redirect($this->_post('continue_url'));
    }

    // ----------------------------------------------------------------------
    
    public function remove_pages_video($id) {
        $delete = $this->db->where('id', $id)->delete('pages_videos');
        
        if($delete){
            redirect($this->_get('next'));
        }
    }

    // ----------------------------------------------------------------------
}