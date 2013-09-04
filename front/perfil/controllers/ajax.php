<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Ajax extends Front_Controller {

    protected $user_area = false;

    public function __construct() {
        parent::__construct();
        
        $this->load->model(array('_bands/page','_bands/pages_song', '_bands/pages_show', '_bands/pages_photo'));
        
        $this->_datos = new \User;
    }

    // ----------------------------------------------------------------------

    /**
     * Save song url.
     * 
     * Guarda las URLs de las canciones
     * de soundcloud para el usuario
     * 
     * @return type
     */
    public function save_song_url() {
        $url = $this->_get('url', true);

        $users_song = new \Users_song;
        $user = new \User;

        $user->get_current();

        $users_song->url = $url;
        $users_song->created_on = datetime_now();

        $ok = $users_song->save($user);
        if ($ok) {
          $this->_data['url'] = $url;
          $intelligence = new Intelligence;
          $intelligence->created_on = datetime_now();
          $intelligence->users_song_id = $users_song->id;

          $intelligence->save($user);
      } else {
            $this->set_alert($users_song->error->string, 'error');
        }

        return $this->render_json($ok);
    }

    // ----------------------------------------------------------------------

    /**
     * Delete songs url.
     * 
     * Borra las URLS de las canciones
     * de souncloud para el usuario
     * 
     * @return type
     */
    public function delete_songs_url() {
        $url = $this->_get('url', true);
        $ok = false;

        $user = new \User;
        $users_song = new \Users_song;
        $user->get_current();

        $users_song->where('url', $url)->where_related($user);

        $users_song->get();

        if ($users_song->exists()) {
            $ok = $users_song->delete();
        }

        return $this->render_json($ok);
    }

    // ----------------------------------------------------------------------

    public function load_shows($inshaka_url = null) {
        $user = new \User;
        $user->get_by_inshaka_url($inshaka_url);
        
        if( ! $user->exists()){
           return '<strong>¡Error en la aplicación!</strong>';
        }

        $this->set_datos($user->users_show->get());
        

        return parent::view('mi_shaka_perfil/shows', false);
    }

    // ----------------------------------------------------------------------
    
    public function load_favorites($id = null) {
        $user = new \User;
        $user->get_by_id($id);
        
        if( ! $user->exists()){
           return '<strong>¡Error en la aplicación!</strong>';
        }

        $this->set_datos($user->users_directorio->get());
        

        return parent::view('mi_shaka_perfil/favoritos', false);
    }

    // ----------------------------------------------------------------------
    
    public function load_posts($inshaka_url = null) {
        $user = new \User;
        $user->get_by_inshaka_url($inshaka_url);
        
        if( ! $user->exists()){
           return '<strong>¡Error en la aplicación!</strong>';
        }

        $this->set_datos($user->intelligence->limit(10)->get());
        $this->_data["is_usuario"] = $this->is_usuario();
        $this->_data["is_inshaka_url"] = $inshaka_url;

        return parent::view('mi_shaka_perfil/posts', false);
    }

    // ----------------------------------------------------------------------

    public function save_show($show_id = null) {
        $user = new \User;
        $user->get_current();

        $users_show = new \Users_show($show_id);

        $users_show->from_array($this->_get(null));

        $ok = $users_show->save($user);

        if (!$ok) {
            $this->set_alert($users_show->error->string, 'error');
        }else{
          $intelligence = new Intelligence;
          $intelligence->created_on = datetime_now();
          $intelligence->users_show_id = $users_show->id;
          
          $intelligence->save($user);
        }

        return $this->render_json($ok);
    }

    // ----------------------------------------------------------------------
    
    public function save_show_loader(){
      $user = new \User;
      $user->get_current();
      
      $users_show = new \Users_show;
      $users_show->date = $this->_get("date");
      $users_show->city = $this->_get("city");
      $users_show->place = $this->_get("place");
      $users_show->adress = $this->_get("adress");
      
      if($users_show->save($user)){
        $intelligence = new \Intelligence;
        $intelligence->created_on = datetime_now();
        $intelligence->users_show_id = $users_show->id;
        $intelligence->save($user);
      }else{
        echo $users_show->error->string;
      }
      
    }
    
    // ----------------------------------------------------------------------

    public function delete_show($show_id = null) {
        $users_show = new \Users_show($show_id);

        $users_show->delete();
    }

    // ----------------------------------------------------------------------

    public function create_comment() {
        $user_id = base64_decode($this->_post('ui')); # ui = User Id on form

        $datos = new \Comment;
        $user = new \User($user_id);

        $datos->from_array($this->_post(null));
        $datos->user_creator_id = $this->userinfo->id;
        $datos->created_on = datetime_now();
        $ok = $datos->save();

        if (true === $ok) {
            if ($user->save_comment($datos)) {
                $this->set_alert('¡Gracias por comentar!');
                $this->load->library('email');
                $this->email->clear();
                $this->_data = array(
                    'user' => $user,
                    'user_creator' => $this->userinfo,
                    'message' => $this->_post('comentario')
                );

                $html = parent::view('mi_shaka_perfil/email_comments');

                $this->email->from(SITEEMAIL, SITENAME);
                $this->email->to($user->email);

                $this->email->subject('Tu perfil fue comentado por '.$this->userinfo->username);
                $this->email->message($html);
                $this->email->send();
            }
        } else {
            $this->set_alert($datos->errors->string, 'error');
        }

        $this->render_json($ok);
    }

    // ----------------------------------------------------------------------

    public function add_video() {
        $video_url = $this->_post('video_url');

        var_dump(is_youtube_url($video_url));
        var_dump(is_vimeo_url($video_url));
    }

    // ----------------------------------------------------------------------
    
    public function update_status() {
        
        $status = $this->_post('status');
        $user = new \User();        
        $user->get_current();
        
        $usuario_notificación = new \User;
        
        $estado = new \Statu;        
        $estado->status = $status;
        $estado->save($user);
        
        $intelligence = new \Intelligence;
        $intelligence->statu_id = $estado->id;
        $intelligence->created_on = datetime_now();
        $intelligence->save($user);
        
        $patron = "/@_?[a-z0-9]+(_?)([a-z0-9]?)+/i";
        $encontrado = preg_match_all($patron, $status, $coincidencias, PREG_OFFSET_CAPTURE);
        if ($encontrado) {
          $notification = new Notification;
          $notification->intelligence_id = $intelligence->id;
          
          foreach ($coincidencias[0] as $coincide) {
            $notification->user_id = $usuario_notificación->get_by_username(trim($coincide[0], "@"))->id;
            $notification->save_as_new();
          }
        }
       
        $user->status = $status;
        
        $ok = $user->where('id', $this->ACL->user_id())->update('status', $status);
        
        return $this->render_json($ok);
    }

    // ----------------------------------------------------------------------
    
    public function save_directorio() {
      
      $directorio = new \Directorio;
      $this->_datos->get_current();
      $inshaka_url = $this->userinfo->inshaka_url;
      
      // Datos que no vienen del post
      $directorio->created_on = datetime_now();
      $directorio->code = $directorio->create_code();
      $directorio->directorio_categoria_id = $this->_datos->id_categoria_proveedor;
      $directorio->user_id = $this->_datos->id;
      $directorio->empresa = $this->_datos->name_proveedor;

      // Datos del formulario
      $directorio->direccion = $this->_post('direccion_empresa');
      $directorio->telefono = $this->_post('phone_provider');
      $directorio->sitio_web = $this->_post('sitio_web');
      $directorio->logo = $this->_post('logo_provider');
      $directorio->facebook = $this->_post('facebook_provider');
      $directorio->twitter = $this->_post('twitter_provider');
      $directorio->youtube = $this->_post('youtube_provider');
      $directorio->descripcion = $this->_post('description_provider');
      $directorio->active = false;
      $directorio->email = $this->_post('email_provider');

      $ok = $directorio->save();
      
       if (true === $ok) {
          $this->set_alert('¡Su perfil será publicado en el directorio!', 'success');
        } else {
          $this->set_alert($directorio->errors->string, 'error');
        }
        $this->set_title('Publicar en directorio');
      return $this->build('editar/save_directorio');
    }
    
    // ----------------------------------------------------------------------
    
    public function photo_profile(){
      
      $id = $this->_get('id');
      $user = $this->_get('user');
      
      echo $this->_get('id');
      $photo_profile = new \Users_photo;
      
      $photo_profile->where('user_id', $user);
      $photo_profile->update('profile_active', false);
      
      $photo_profile->where('id', $id);
      $photo_profile->update('profile_active', true); 

    }
    
    // ----------------------------------------------------------------------
    
    public function save_song_url_page($id = NULL) {
        $url = $this->_get('url', true);

        $pages_song = new \Pages_song;
        $page = new \Page;

        $page->get_by_id($id);

        $pages_song->url = $url;
        $pages_song->created_on = datetime_now();

        $ok = $pages_song->save_as_new($page);
        if ($ok) {
            $this->_data['url'] = $url;
        } else {
            $this->set_alert($pages_song->error->string, 'error');
        }

        return $this->render_json($ok);
    }

    // ----------------------------------------------------------------------
    
    public function save_show_page($show_id = null) {
        $page = new \Page;
        $page->get_by_id('1');

        $pages_show = new \Pages_show($show_id);

        $pages_show->from_array($this->_get(null));

        $ok = $pages_show->save($page);
        
        
       

        if (!$ok) {
            $this->set_alert($pages_show->error->string, 'error');
        }

        return $this->render_json($ok);
    }

    // ----------------------------------------------------------------------
    
    public function load_shows_page($var = null) {
        $page = new \Page;
        $page->get_by_var($var);
        
        if( ! $page->exists()){
           return '<strong>¡Error en la aplicación!</strong>';
        }

        $this->set_datos($page->pages_show->get());
        

        return parent::view('mis_paginas/shows', false);
    }

    // ----------------------------------------------------------------------
    
    public function create_comment_page() {
        $page_id = base64_decode($this->_post('ui')); # ui = Page Id on form

        $datos = new \Comment;
        $page = new \Page($page_id);

        $datos->from_array($this->_post(null));
        $datos->user_creator_id = $this->userinfo->id;
        $datos->created_on = datetime_now();
        $ok = $datos->save();

        if (true === $ok) {
            if ($page->save_comment($datos)) {
                $this->set_alert('¡Gracias por comentar!');
                $this->load->library('email');
                $this->email->clear();
                $this->_data = array(
                    'page' => $page,
                    'user_creator' => $this->userinfo,
                    'message' => $this->_post('comentario')
                );

                $html = parent::view('mis_paginas/email_comments');

                $this->email->from(SITEEMAIL, SITENAME);
                $this->email->to($page->band->user->email);

                $this->email->subject('Tu perfil fue comentado por '.$this->userinfo->username);
                $this->email->message($html);
                $this->email->send();
            }
        } else {
            $this->set_alert($datos->errors->string, 'error');
        }

        $this->render_json($ok);
    }

    // ----------------------------------------------------------------------
    
    public function update_status_page() {
        
        $status = $this->_post('status');
        $id = $this->_post('id');
        $page = new \Page();
      
        $page->status = $status;
        
        $ok = $page->where('id', $id)->update('status', $status);
        
        return $this->render_json($ok);
    }
    
    // ----------------------------------------------------------------------
    
    public function delete_follow(){
      $id = $this->_get('id');
      
      // Cargamos la tabla
      $users_follow = new \Users_follow($id);

      if($users_follow->exists()){
        $users_follow->where('id', $id)->get()->delete();
        $users_follow->check_last_query();
      }
      
      
    }

    // ----------------------------------------------------------------------
    
    public function photo_profile_page(){
      
      $id = $this->_get('id');
      $page = $this->_get('page');
      
      echo $this->_get('id');
      $photo_profile = new \Pages_photo;
      
      $photo_profile->where('page_id', $page);
      $photo_profile->update('profile_active', false);
      
      $photo_profile->where('id', $id);
      $photo_profile->update('profile_active', true); 

    }
    
    // ----------------------------------------------------------------------
    
    protected function comprobarhttp($url){
      if(!preg_match('#^http://.*#s', trim($url))){
        $url = "http://".$url;
      }
      return $url;
    }
    
    // ----------------------------------------------------------------------
    
    public function do_upload() {
      // Cargamos datos del usuario
      $user = new \User;
      $user->get_current();
      
      // Cargamos el objeto de las fotos de usuario
      $users_photo = new \Users_photo;
      
      if (!empty($_FILES)) {
        $tempFile = $_FILES['file']['tmp_name'];
        $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/'.$user->username."/photos/";
        $targetFile = $targetPath . $_FILES['file']['name'];
        move_uploaded_file($tempFile, $targetFile);
        
        // Guardamos en base de datos
        $users_photo->image = $user->username."/photos/".$_FILES['file']['name'];
        $users_photo->thumb = $user->username."/photos/".$_FILES['file']['name'];
        
        // Creamos la notificación
        if($users_photo->save($user)) {
          $intelligence = new \Intelligence;
          $intelligence->created_on = datetime_now();
          $intelligence->users_photo_id = $users_photo->id;
          $intelligence->save($user);
        }        
      }
    }

    // ----------------------------------------------------------------------
    
}