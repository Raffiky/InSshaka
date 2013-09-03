<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Social extends Front_Controller {

    protected $user_area = true;
    private $_datos = null;
    private $_count = 0;

    public function __construct() {
        parent::__construct();

        // Mostrar header del perfil del usuario
        $this->show_header_perfil = true;

        // Cargando datos
        $this->_datos = new \Users_follow;
    }

    // ----------------------------------------------------------------------
    
    public function index($page = 1){
      $this->set_title('InShaka Social');
      $user_photo = new \Users_photo;
      $this->_data['user_photo'] = $user_photo;
      $i_am_fan = clone $this->_datos;
      $usuario_fan = new \User;
      $this->_data['usuario_fan'] = $usuario_fan;

      $paginator_url = site_url('perfil/social/index/%d/');
      $this->_data['paginator_url'] = $_SERVER['QUERY_STRING'] ? $paginator_url . '?' . $_SERVER['QUERY_STRING'] : $paginator_url;
      $this->_data['count'] = $this->_count;
      
      if(!$this->_post(NULL)){
        $this->_datos->where(array('user_follow_id' => $this->userinfo->id, 'allow_follow' => true))->get_paged($page, 12);
        $i_am_fan->where(array('user_id' => $this->userinfo->id, 'allow_follow' => true))->get_paged($page, 12);
      }      

      $this->set_datos($this->_datos);
      $this->_data['i_am_fan'] = $i_am_fan;
      
      return $this->build('mis_fans/body');
    }
    
    // ----------------------------------------------------------------------
    
    public function buscar($page = 1){
      $keyword = $this->_post('s', true);
      $name = explode(chr(32), $keyword);

      $like = array(
          'first_name' => $name[0]
      );
      
      $this->_datos->where('user_follow_id', $this->userinfo->id)->like_related('user', 'first_name', $like['first_name'])->get_paged($page, 12);

      return $this->index($page = 1);
    }

    // ----------------------------------------------------------------------
    
    public function follow(){
      $id = $this->_get('id');
      
      $this->_datos->where(array('user_id' => $this->userinfo->id, 'user_follow_id' => $id ))->get();
      
      if(!$this->_datos->exists()){
        
        $this->_datos->user_id = $this->userinfo->id;
        $this->_datos->user_follow_id = $id;
        $this->_datos->created_on = datetime_now();

        if($this->_datos->save()){
          $this->load->library('email');
          $this->email->clear();

          $user_photo = new \Users_photo;

          $datos_usuario = new \User;

          $user = clone $datos_usuario;
          $user->get_by_id($this->userinfo->id);

          $user_follow = clone $datos_usuario;
          $user_follow->get_by_id($id);

          $this->_data = array(
              'user' => $user,
              'user_follow' => $user_follow,
              'photo' => $user_photo,
              'datos_user' => $datos_usuario,
              'id' => $this->_datos->id
          );

          $html = parent::view('mis_fans/email/new_follower');

          $this->email->from(SITEEMAIL, SITENAME);
          $this->email->to($user_follow->email);

          $this->email->subject('Tienes un nuevo seguidor en Inshaka!');
          $this->email->message($html);
          $this->email->send();
        }
      }  else {
        $this->_datos
                ->where(array('user_id' => $this->userinfo->id, 'user_follow_id' => $id))->get()
                ->delete();
          
        $this->set_message("Ya sigues a este usuario", "error");
      }
      
    }
    
    // ----------------------------------------------------------------------
    
    public function allow_follow(){
      $id = $this->_get('id');
      $status = $this->_get('status');      
      $datos = $this->_datos->get_by_id($id);
      $users_follow = new \Users_follow;
      
      $intelligence = new Intelligence;
      
      if($datos->exists()){
        switch ($status) {
          case "Allow":
            $this->_datos->where('id', $id)->update('allow_follow', true);          
            
            $intelligence->user_id = $this->_datos->user_follow_id;
            $intelligence->users_follow_id = $id;
            $intelligence->created_on = datetime_now();
            
            if($intelligence->save()){
              $notification = new \Notification;
              $notification->user_id = $this->_datos->user_id;
              $notification->intelligence_id = $intelligence->id;
              $notification->save();
            }
            break;
          case "Deny":
            $users_follow->where('id', $id)->get()->delete();
            break;
          default:
            $this->_datos->where('id', $id)->get()->delete();
            break;
        }
      }else{
        $this->set_alert("El usuario ya no existe", "error");
      }
    }
    
    // ----------------------------------------------------------------------
    
    public function ready_notify(){      
      $id = $this->_get('id');
      $notificacion = new \Notification;
      $datos = $notificacion->get_by_id($id);
      
      if($datos->exists()){
        $notificacion->where('id', $id)->update('ready', true);
      }
    }
    
    // ----------------------------------------------------------------------
    
    public function detalle(){
      $this->set_title("Detalle de notificación");
      $id = $this->_get('id');
      $this->show_header_perfil = false;
      
      $usuario = new \User;
      $this->_data['usuario'] = $usuario;
      
      // Cargando fotos de usuario
      $photo = new Users_photo;
      $this->_data['photo'] = $photo;
      
      // Cargando total de comentarios
      $intelligence_comments = new \Intelligences_comment;
      $this->_data['intelligence_comments'] = $intelligence_comments;
      
      $notificacion = new \Notification;
      $datos = $notificacion->get_by_id($id);
      
      $titulo = null;
      
      if(!empty($datos->intelligence->audicion_id)){
        $titulo = $datos->intelligence->audicion->titulo;
      }elseif(!empty ($datos->intelligence->clasificado_id)) {
        $titulo = $datos->intelligence->clasificado->titulo;
      }elseif(!empty ($datos->intelligence->band_id)){
        $titulo = $datos->intelligence->band->name;
      }elseif(!empty ($datos->intelligence->directorio_id)){
        $titulo = $datos->intelligence->directorio->empresa;
      }elseif(!empty($datos->intelligence->statu_id)){
        $titulo = $datos->user->username;
      }elseif(!empty($datos->intelligence->audiciones_aplicacion_id)){
        $titulo = $datos->intelligence->audiciones_aplicacion->audicion->titulo;
      }
      
      $this->set_title($titulo);
      $this->set_datos($datos);
      
      return $this->build('home/social/detalle');
    }

    // ----------------------------------------------------------------------
    
    public function get_users() {
      $user = new \User;
      $my_followers = $this->_datos; 
      $prueba = $this->input->get('term'); 
      
      if (isset($prueba)){
        $q = strtolower($prueba);
        $my_followers->where(array('user_follow_id' => $this->userinfo->id, 'allow_follow' => true));
        $my_followers->group_start()->like_related('user', 'first_name', $q);
        $my_followers->or_like_related('user', 'last_name', $q)->group_end();
        $resultado = $my_followers->get();
        
        if($resultado->exists()){
          foreach ($resultado->all_to_array() as $row){
            $new_row['label']=htmlentities(stripslashes($user->get_name($row['user_id'])));
            $new_row['value']=htmlentities(stripslashes($user->get_name($row['user_id'])));
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
      }
    }
    
    // ----------------------------------------------------------------------
    
    public function get_fans() {
      $user = new \User;
      $my_followers = $this->_datos; 
      $prueba = $this->input->get('term'); 
      
      if (isset($prueba)){
        $q = strtolower($prueba);
        $my_followers->where(array('user_id' => $this->userinfo->id, 'allow_follow' => true));
        $my_followers->group_start()->like_related('user', 'first_name', $q);
        $my_followers->or_like_related('user', 'last_name', $q)->group_end();
        $resultado = $my_followers->get();
        
        if($resultado->exists()){
          foreach ($resultado->all_to_array() as $row){
            $new_row['label']=htmlentities(stripslashes($user->get_name($row['user_follow_id'])));
            $new_row['value']=htmlentities(stripslashes($user->get_name($row['user_follow_id'])));
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
      }
    }
    
    // ----------------------------------------------------------------------
    
    public function save_comment(){
      $id = $this->_post('id');
      $comentario = $this->_post('comentario');
      
      $user = new \User;
      $user->get_current();
      
      $intelligences = new \Intelligence;
      $intelligences->get_by_id($id);
      
      if($intelligences->exists()){
        
        $intelligences_comment = new \Intelligences_comment;
        $intelligences_comment->intelligence_id = $id;
        $intelligences_comment->comentario = $comentario;
        $intelligences_comment->user_id = $user->id;
        $intelligences_comment->created_on = datetime_now();
        
        if($intelligences_comment->save()){
          $notification = new \Notification;
          $notification->user_id = $intelligences->user_id;
          $notification->intelligence_id = $id;
          
          $notification->save();
          
          $patron = "/@_?[a-z0-9]+(_?)([a-z0-9]?)+/i";
          $encontrado = preg_match_all($patron, $comentario, $coincidencias, PREG_OFFSET_CAPTURE);
          if ($encontrado) {
            $usuario_notificación = new \User;
            $notification_user = new Notification;
            $notification_user->intelligence_id = $intelligences->id;

            foreach ($coincidencias[0] as $coincide) {
              $notification_user->user_id = $usuario_notificación->get_by_username(trim($coincide[0], "@"))->id;
              $notification_user->save_as_new();
            }
          }
        }
      }
    }
    
    // ---------------------------------------------------------------------- 
    
    public function load_comments($intelligence = null){
      $intelligence_comments = new \Intelligences_comment;
      $intelligence_comments->get_by_intelligence_id($intelligence);
      
      if($intelligence_comments->exists()){
        // Cargando fotos de usuario
        $photo = new Users_photo;
        $this->_data['photo'] = $photo;
        
        $usuario = new \User;
        $this->_data['usuario'] = $usuario;
        
        $this->set_datos($intelligence_comments);
        return parent::view('home/social/comments_inshaka', false);
      }
    }
    
    // ----------------------------------------------------------------------
    
    public function find_inshaka($page = 1){
      // Ocultando header del perfil del usuario
      $this->show_header_perfil = false;
        
      $field = $this->_post('find-inshaka-users');
      $this->set_title('Buscador InShaka');
      $datos = null;
      
      $user = new \User;
      $band = new \Band;
      $audiciones = new \Audicion;
      $clasificados = new \Clasificado;
      $user_photo = new \Users_photo;
      $this->_data['user_photo'] = $user_photo;
      
      if(!empty($field)){
        $name = explode(chr(32), $field);
        $user->distinct('username')->like('first_name', $name[0])->or_like_related('musical_gender', 'name', $field)->or_like_related('talent', 'name', $field)->get_paged($page, 100);
        $band->like('name', $field)->or_like_related('musical_gender', 'name', $field)->get_paged($page, 100);
        $audiciones->like('titulo',$field)->or_like('descripcion', $field)->get_paged($page, 100);
        $clasificados->like('titulo', $field)->or_like('descripcion', $field)->get_paged($page, 100);
        $directorio = $user->like('name_proveedor', $field)->get_paged($page, 100);

        if($user->exists()){
          $this->_data['find_user'] = $user;
          if ($this->_get(null)) {
            $datos = $user;            
            $paginator_url = site_url('perfil/social/find_inshaka/pagina/%d/');
            $this->_data['paginator_url'] = $_SERVER['QUERY_STRING'] ? $paginator_url . '?' . $_SERVER['QUERY_STRING'] : $paginator_url;
          }
          $this->_count = $user->count_distinct();
        }
        if($band->exists()){
          $this->_data['find_band'] = $band;
          if ($this->_get(null)) {
            $datos = $band;            
            $paginator_url = site_url('perfil/social/find_inshaka/pagina/%d/');
            $this->_data['paginator_url'] = $_SERVER['QUERY_STRING'] ? $paginator_url . '?' . $_SERVER['QUERY_STRING'] : $paginator_url;
          }
          $this->_count = $band->count_distinct();
        }
        if($audiciones->exists()){
          $this->_data['find_audiciones'] = $audiciones;
          if ($this->_get(null)) {
            $datos = $audiciones;            
            $paginator_url = site_url('perfil/social/find_inshaka/pagina/%d/');
            $this->_data['paginator_url'] = $_SERVER['QUERY_STRING'] ? $paginator_url . '?' . $_SERVER['QUERY_STRING'] : $paginator_url;
          }
          $this->_count = $audiciones->count_distinct();
        }
        if($clasificados->exists()){
          $this->_data['find_clasificados'] = $clasificados;
          if ($this->_get(null)) {
            $datos = $clasificados;            
            $paginator_url = site_url('perfil/social/find_inshaka/pagina/%d/');
            $this->_data['paginator_url'] = $_SERVER['QUERY_STRING'] ? $paginator_url . '?' . $_SERVER['QUERY_STRING'] : $paginator_url;
          }
          $this->_count = $clasificados->count_distinct();
        }
        if($directorio->exists()){
          $this->_data['find_directorio'] = $directorio;
          if ($this->_get(null)) {
            $datos = $directorio;            
            $paginator_url = site_url('perfil/social/find_inshaka/pagina/%d/');
            $this->_data['paginator_url'] = $_SERVER['QUERY_STRING'] ? $paginator_url . '?' . $_SERVER['QUERY_STRING'] : $paginator_url;
          }
          $this->_count = $directorio->count_distinct();
        }
        
        return $this->build('home/social/find');
      }
      
    }

    // ----------------------------------------------------------------------
    
    public function load_data(){
      // Cargando datos de usuario
      $user = new User;
      $user->get_current();
      $this->_data['userinfo'] = $user;
      
      $usuario = new \User;
      $this->_data['usuario'] = $usuario;
      
      // Cargando follows
      $follow = new Users_follow;
      $follow->get_by_related($user);
      $this->_data['seguidos_por_mi'] = $follow;

      // Clone followers
      $clone_f = clone $follow;
      $this->_data['clone_f'] = $clone_f;
            
      // Cargando interacciones
      $intelligence = new Intelligence;
      $intelligence->where('id <', $this->_post('id'))
              ->where_in_subquery('user_id', $follow->select('user_follow_id')->where_related($user))
              ->limit(5)->get();
      $this->_data['interacciones'] = $intelligence;
      $this->_data['total_resultados'] = $intelligence->result_count();
      
      // Cargando total de comentarios
      $intelligence_comments = new \Intelligences_comment;
      $this->_data['intelligence_comments'] = $intelligence_comments;
      
      // Cargando fotos de usuario
      $photo = new Users_photo;
      $this->_data['photo'] = $photo;
        
      $this->set_datos($intelligence);
      
      if($intelligence->exists())
        return parent::view('home/social/load_notifications', false); 
    }
    
    // ----------------------------------------------------------------------
    
    public function load_self_data(){
      // Cargando datos de usuario
      $user = new User;
      $user->get_current();
      $this->_data['userinfo'] = $user;
      
      $usuario = new \User;
      $this->_data['usuario'] = $usuario;
      
      // Cargando follows
      $follow = new Users_follow;
      $follow->get_by_related($user);
      $this->_data['seguidos_por_mi'] = $follow;

      // Clone followers
      $clone_f = clone $follow;
      $this->_data['clone_f'] = $clone_f;
            
      // Cargando interacciones
      $intelligence = new Intelligence;
      $intelligence->where('id <', $this->_post('id'))
              ->where_related($user)
              ->limit(5)->get();
      $this->_data['interacciones'] = $intelligence;
      $this->_data['total_resultados'] = $intelligence->result_count();
      
      // Cargando total de comentarios
      $intelligence_comments = new \Intelligences_comment;
      $this->_data['intelligence_comments'] = $intelligence_comments;
      
      // Cargando fotos de usuario
      $photo = new Users_photo;
      $this->_data['photo'] = $photo;
        
      $this->set_datos($intelligence);
      
      if($intelligence->exists())
        return parent::view('perfil/mi_shaka_perfil/posts', false); 
    }
    
    // ---------------------------------------------------------------------

}