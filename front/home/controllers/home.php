<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Home extends Front_Controller {

    public function __construct() {
        parent::__construct();

        // Mostrar banner principal
        $this->show_principal_banner = true;
    }

    // ----------------------------------------------------------------------

    public function index() {
        $this->set_title('Bienvenidos a Inshaka Entertainment', true);

        // Cargando noticias
        $news = new News;
        $this->_data['news'] = $news->get();

        // Cargando audiciones
        $audiciones = new Audicion;
        $this->_data['audiciones'] = $audiciones->get_only_actives();

        // Cargando clasificados
        $clasificados = new Clasificado;
        $this->_data['clasificados'] = $clasificados->get_only_actives();
        
        $body = 'body';
        if ($this->is_usuario()) {
            $user = new User;
            $user->get_current();
            
            $body = 'body_logged';
                        
            // Cargando follows
            $follow = new Users_follow;
            $follow->get_by_related($user);
            $this->_data['seguidos_por_mi'] = $follow;
            
            // Clone followers
            $clone_f = clone $follow;
            $this->_data['clone_f'] = $clone_f;
            
            // Cargando interacciones
            $intelligence = new Intelligence;
            $intelligence
                    ->where_in_subquery('user_id', $follow->select('user_follow_id')->where_related($user))
                    ->limit(10)->get();
            $this->_data['interacciones'] = $intelligence;
            
            // Cargando total de comentarios
            $intelligence_comments = new \Intelligences_comment;
            $this->_data['intelligence_comments'] = $intelligence_comments;
            
            // Cargando fotos de usuario
            $photo = new Users_photo;
            $this->_data['photo'] = $photo;

            // Cargando bandas
            $bandas = new Band();
            $this->_data['bands'] = $bandas->get_all_current_user();

            $bands_instruments_user = new Bands_instruments_user;
            $favoritos = new Users_directorio;
            $banda_pertenezco = clone $bands_instruments_user;
            $pertenezco = $banda_pertenezco->get_band($user->id);
            
            $this->_data['mis_invitaciones'] = $bands_instruments_user->get_invitation_current_user();
            $this->_data['mis_bandas'] = $bandas->get_all_current_user();
            $this->_data['mis_favoritos'] = $favoritos->get_by_user_id($user->id);
            $this->_data['banda_pertenezco'] = $pertenezco;

            //$audiciones_aplicaciones = new Audiciones_aplicacion;

            //$audiciones_aplicaciones->get_by_related_user($user);

            $this->_data['audiciones'] = $audiciones->get_only_actives();

            $directorio = new Directorio;
            $this->_data['directorio'] = $directorio->get_by_related($user);

            $clasificados_categoria = new Clasificados_categoria;
            $this->_data['clasificados_categoria'] = $clasificados_categoria->get();
        }

        return $this->build($body);
    }

    // ----------------------------------------------------------------------
    
    public function random_user(){
      $user = new User;
      $user->get_current();
      
      // Cargando fotos de usuario
      $photo = new Users_photo;
      $this->_data['photo'] = $photo;
      
      // Cargando follows
      $follow = new Users_follow;
      $follow->get_by_related($user);
      $this->_data['seguidos_por_mi'] = $follow;
      
      // Cargando usuarios
      $random_users = clone $user;
      $cantidad = $random_users
              ->where(array("is_proveedor" => false, "id !=" => $this->userinfo->id))
              ->get()
              ->result_count();
      $aleatorio = rand(0, $cantidad - 1);
      
      if($aleatorio < 5) {
        $aleatorio = 5;
      }
      
      $random_users
              ->where("is_proveedor", false)
              ->where_not_in("id", $this->userinfo->id)
              ->where_not_in_subquery("id", $follow->select('user_follow_id')->where_related($user))
              ->limit(5,$aleatorio)
              ->get();
      $this->_data['random_users'] = $random_users;
      
      return parent::view('social/sugerencias_inshaka', false);
    }
    
    // ----------------------------------------------------------------------
    
    public function get_all() {
      $banda = new \Band;
      $user = new \User;
      $clasificado = new \Clasificado;
      $audicion = new \Audicion;
      $prueba = $this->input->get('term'); 
      
      if (isset($prueba)){
        $q = strtolower($prueba);
        
        $banda->like('name', $q);
        $user->where('is_proveedor', false)->like('first_name', $q);
        $clasificado->like('titulo', $q);
        $audicion->like('titulo', $q);
        
        $resultado = $banda->get();
        $resultado2 = $user->get();
        $resultado3 = $clasificado->get();
        $resultado4 = $audicion->get();
        
        if($resultado->exists() || $resultado2->exists() || $resultado3->exists() || $resultado4->exists() ){
          foreach ($resultado->all_to_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['name']));
            $new_row['value']=htmlentities(stripslashes($row['name']));
            $row_set[] = $new_row; //build an array
          }
          foreach ($resultado2->all_to_array() as $row2){
            $new_row2['label']=htmlentities(stripslashes($row2['first_name']." ".$row2['last_name']));
            $new_row2['value']=htmlentities(stripslashes($row2['first_name']." ".$row2['last_name']));
            $row_set[] = $new_row2; //build an array
          }
          foreach ($resultado3->all_to_array() as $row3){
            $new_row3['label']=htmlentities(stripslashes($row3['titulo']));
            $new_row3['value']=htmlentities(stripslashes($row3['titulo']));
            $row_set[] = $new_row3; //build an array
          }
          foreach ($resultado4->all_to_array() as $row4){
            $new_row4['label']=htmlentities(stripslashes($row4['titulo']));
            $new_row4['value']=htmlentities(stripslashes($row4['titulo']));
            $row_set[] = $new_row4; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
      }
    }
    
    // ----------------------------------------------------------------------
    
    public function random_sugerencias(){
      $user = new User;
      $user->get_current();
      
      // Cargando follows
      $follow = new Users_follow;
      $follow->get_by_related($user);
      $conteo = new Users_follow;
      $this->_data['cuantos_sigo'] = $conteo->where('user_id', $this->userinfo->id)->get();
      $this->_data['seguidos_por_mi'] = $follow;
      
      // Cargando fotos de usuario
      $photo = new Users_photo;
      $this->_data['photo'] = $photo;
      
      // Cargando usuarios
      $random_users = clone $user;
      $cantidad = $random_users
              ->where(array("is_proveedor" => false, "id !=" => $this->userinfo->id))
              ->get()
              ->result_count();
      $aleatorio = rand(6, $cantidad - 10);
      
      if($aleatorio < 5) {
        $aleatorio = 5;
      }
      
      $random_users
              ->where("is_proveedor", false)
              ->where_not_in("id", $this->userinfo->id)
              ->where_not_in_subquery("id", $follow->select('user_follow_id')->where_related($user))
              ->limit(5,$aleatorio)
              ->get();
      $this->set_datos($random_users);
      
      return parent::view('social/sugerencias_registro', false);
    }
    
    // ----------------------------------------------------------------------
}
