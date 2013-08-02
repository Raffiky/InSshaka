<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Editar extends Front_Controller {

    protected $user_area = true;
    private $_datos = null;

    public function __construct() {
        parent::__construct();
        
        $this->load->model('_directorio/directorio_categoria');

        $user = new \User;
        $this->_datos = $user->get_current();
    }

    // ----------------------------------------------------------------------

    public function informacion_personal($registro = null) {
      $this->_data['go_register'] = $registro;
      $this->set_datos($this->_datos)->set_title('Editar información personal')->build('editar/informacion_personal');
    }

    // ----------------------------------------------------------------------

    public function save_informacion_personal($text = null) {

        if ($this->_post(null)) {

            $ok = $this->_datos->from_array($this->_post(null), null, true);

            if (!$ok) {
                $this->set_alert($this->_datos->error->string, 'error');
            } else {
                // Si se sube una imagen, ejecutar el upload
                // Si no, lanzar el mensaje de success
                if (!empty($_FILES['profile_picture']['name'])) {

                    $path = UPLOADSFOLDER . $this->userinfo->username;

                    if (!is_dir($path)) {
                        @mkdir($path);
                        @chmod($path, 0777);
                    }

                    $config['upload_path'] = $path;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['encrypt_name'] = true;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('profile_picture')) {
                        $this->set_alert('Se guardo la información pero se presentaron los siguientes errores subiendo la imagen de perfil: ' . $this->upload->display_errors(), 'error');
                    } else {

                        // Borrando imagen actual
                        if (!empty($this->_datos->profile_picture)) {
                            @unlink(UPLOADSFOLDER . $this->_datos->profile_picture);
                        }

                        // Limpiando el path del logo para guardarlo
                        $datos_image = $this->upload->data();
                        $path = str_replace(UPLOADSFOLDER, '', $datos_image['full_path']);

                        $config['source_image'] = $datos_image['full_path'];
                        $config['master_dim'] = 'width';
                        $config['new_image'] = $datos_image['full_path'];
                        $config['width'] = 253;
                        $config['height'] = 200;

                        $this->load->library('image_lib', $config);

                        if (!$this->image_lib->resize()) {
                            $this->set_alert('Información guardada pero hubo un error al remasterizar la imagen de perfi. Verifique que la imagen tenga las medidas recomendadas', 'error');
                        } else {
                            $this->_datos->profile_picture = $path;
                            if ($this->_datos->save()) {
                                $this->set_alert('Información e imagen de perfil guardados correctamente.  <a href="'.$this->urls->current_profile.'">Volver al perfil.</a>', 'success');
                            } else {
                                $this->set_alert('Información guardada pero hubo un error al actualizar la imagen de perfi.', 'error');
                            }
                        }
                    }
                } else {
                    $this->set_alert('Información personal editada correctamente. <a href="'.$this->urls->current_profile.'">Volver al perfil.</a>', 'success');
                }
            }
        }
        
        if ($text != null){
          return redirect(site_url()."#first-sugerencias");
        }else{
          return $this->informacion_personal();
        }
    }

    // ----------------------------------------------------------------------

    public function informacion_profesional() {

        // Loads a config file named blog_settings.php and assigns it to an index named "blog_settings"
        $config = $this->config->load('_users/informacion_profesional', TRUE);

        $datos = $this->_datos->users_personal_info;
        
        $this->_data['proveedor'] = $this->_datos;

        $this->_data['options'] = $config['options'];

        $talentos = new \Talents_category;
        $this->_data['talentos'] = $talentos->get();
        
        // Categoria del proveedor
        $categoria = new \Directorio_categoria;
        $this->_data['categoria'] = $categoria->get();
        
        // Talentos del usuario actual
        $talentos_user = new \Talent;
        $this->_data['current_talents'] = $talentos_user->get_all_from_user($this->_datos);
        
        // Musical genders
        $musical_genders = new \Musical_gender;
        $this->_data['musical_genders'] = $musical_genders->get();
       
        

        $this->set_datos($datos)->set_title('Editar información profesional')->build('editar/informacion_profesional');
    }

    // ----------------------------------------------------------------------

    public function save_informacion_profesional() {
        if ($this->_post(null)) {
            $talentos = $this->_post('talentos');
            $musical_genders = $this->_post('musical_genders');
            $talent = new \Talent;
            $musical_gender = new \Musical_gender;
            

            $datos = $this->_datos->users_personal_info;
			
            $ok = $datos->from_array($this->_post(null), null, true);

            if (!$ok) {
                $this->set_alert($this->_datos->error->string, 'error');
            } else {
                  $this->set_alert('Información profesional editada correctamente. <a href="'.$this->urls->current_profile.'">Volver al perfil.</a>', 'success');
            }

            $this->db->where('user_id', $this->_datos->id)->delete('users_talents');
            //print_r($talentos);exit;
            if (!empty($talentos)) {
                foreach ($talentos as $talento) {
                    $talent->get_by_id($talento);
                    if($talent->exists()){
                        $talent->save_user($this->_datos);
					}
                    
                }
            }
            
            $this->db->where('user_id', $this->_datos->id)->delete('users_musical_genders');
            
             if (!empty($musical_genders)) {
                foreach ($musical_genders as $musical_gender_id) {
                    $musical_gender->get_by_id($musical_gender_id);
                    if($musical_gender->exists()){
                        $musical_gender->save_user($this->_datos);
                    }
                    
                }
            }	
            
        }

        return $this->informacion_profesional();
    }

    // ----------------------------------------------------------------------
    
    public function informacion_personal_page($var = null) {
      $page = new \Page;
      $page->get_by_var($var);
      $this
            ->set_datos($page)
            ->set_title('Editar información personal')
            ->build('mis_paginas/editar/informacion_personal');
    }

    // ----------------------------------------------------------------------
    
    public function save_informacion_personal_page() {
        $page = new \Page;
        $banda = new \Band;
        
        $banda_name = $this->_post('name');
        $banda_id = $this->_post('band');
        $page_id = $this->_post('id');
        $bio = $this->_post('bio');
        
        if(!empty($banda_name)){
          $ok = $banda->where('id', $banda_id)->update('name',$banda_name);
        }
        
        if(!empty($bio)){
          $ok = $page->where('id', $page_id)->update('bio',$bio);
        }

        if (!$ok) {
           $this->set_alert($page->error->string, 'error');
        } else {
           $this->set_alert('Información personal editada correctamente.', 'success');

        }

        return $this->informacion_personal_page($page->var);
    }

    // ----------------------------------------------------------------------
    
    public function informacion_profesional_page($var = null) {
        
        $page = new \Page;
        $var = str_replace('_', '-', $var);
        $page->get_by_var($var);
        
        // Loads a config file named blog_settings.php and assigns it to an index named "blog_settings"
        $config = $this->config->load('_users/informacion_profesional', TRUE);
        $this->load->model(array('_bands/pages_info'));

        $datos = $page;

        $this->_data['options'] = $config['options'];        

        $this
              ->set_datos($datos)
              ->set_title('Editar información profesional')
              ->build('mis_paginas/editar/informacion_profesional');
    }

    // ----------------------------------------------------------------------
    
    public function save_informacion_profesional_page() {
        $this->load->model(array('_bands/pages_info'));
        
        
        if ($this->_post(null)) {
           $id_page = $this->_post('page_id');
           
           $page = new \Page;
           $page_info = new \Pages_info;
           
           $page->get_by_id($id_page);
           
           $ok = $page_info->get_by_page_id($page->id)->delete_all();          
           
            if (!$ok) {
              $this->set_alert($page_info->error->string, 'error');
            } else {
              $page_info->from_array($this->_post(null), null, true);
              $this->set_alert('Información profesional editada correctamente.', 'success');
            }
            
        }

        return $this->informacion_profesional_page($page->var);
    }

    // ----------------------------------------------------------------------
}