<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Directorios extends Front_Controller {

    protected $user_area = false;
    private $_datos = null;
    private $_page = 1;
    private $_tab_content = 'categorias';
    private $_title = 'Categorias';

    public function __construct() {
        parent::__construct();

        $this->_datos = new Directorio;

        $this->_datos->where('active', true);
    }

    // ----------------------------------------------------------------------

    public function index() {
      
//        $usuario = new \User;

        $directorio_categorias = new Directorio_categoria();

        $this->_datos->get_paged($this->_page, 10);

        $this->set_datos($this->_datos);
        
        $this->_data['tab_content'] = parent::view($this->_tab_content, true, array(
                    'select_categorias' => $directorio_categorias->get_for_select('Seleccione'),
                    'categorias' => $directorio_categorias->get()
                ));

        $this->_data['tab_content_active'] = $this->_tab_content;
//        $this->_data['usuario'] = $usuario->get_current();
        $this->_data['es_usuario'] = $this->is_usuario();

        return $this->set_title('Directorio - ' . $this->_title)->build();
    }

    // ----------------------------------------------------------------------

    public function page($page = 1) {
        $this->_page = $page;
        return $this->index();
    }

    // ----------------------------------------------------------------------

    public function buscador($page = 1) {
        $this->_tab_content = 'buscador';
        $this->_title = 'Buscador';
        
        // Cargando usuario
        $user = new \User;

        $this->_datos->clear();
        
        $keyword = $this->_get('s', true);

        $like = array(
            'empresa' => $keyword,
            'direccion' => $keyword,
            'telefono' => $keyword,
            'sitio_web' => $keyword,
            'email' => $keyword
        );

        $this->_datos->group_start()->or_ilike($like)->group_end();
        
        $this->_page = $page;
        $this->_data['user'] = $user;

        return $this->index();
    }

    // ----------------------------------------------------------------------

    public function a_z($letter = 'A', $page = 1) {
        $this->_tab_content = 'a_z';
        $this->_title = 'A - Z';
        
        
        // Cargando usuario
        $user = new \User;

        if (!empty($letter)) {
            $this->_data['letter_active'] = $letter;

            $this->_datos->clear();
            $this->_datos->ilike('empresa', $letter, 'after');
        }

        $this->_page = $page;
        $this->_data['user'] = $user;

        return $this->index();
    }

    // ----------------------------------------------------------------------

    public function crear_anuncio() {
        $this->_tab_content = 'crear_anuncio';
        $this->_title = 'Crear anuncio';

        return $this->index();
    }

    // ----------------------------------------------------------------------

    public function crear() {

        $user = new User;
        $user->get_current();

        $directorio = new Directorio;

        $adicionales = $this->_post('adicionales');
        $datos = $this->_post(null);

        $directorio->from_array($datos);

        // Datos que no vienen del post
        $directorio->created_on = datetime_now();
        $directorio->code = $directorio->create_code();
      //  $directorio->image = $directorio->_post(image);
        $ok = $directorio->save($user);

        if ($ok) {
            $this->set_alert('Anuncio creado exitosamente, ahora redireccionando', 'success');

            // Guardando los adicionales en caso de que existan
            $directorio_adicionales = new Directorio_adicional;
            if (!empty($adicionales)) {
                foreach ($adicionales as $adicional) {
                    $directorio_adicionales->name = $adicional;

                    $directorio_adicionales->save_as_new($directorio);
                }
            }
        } else {
            $this->set_alert($directorio->error->string, 'error');
        }

        $this->_data['continue_url'] = site_url('perfil/directorios');

        return $this->render_json($ok);
    }

    // ----------------------------------------------------------------------
    
    public function add_favorite(){
      
      $id = $this->_get('id');
      $user = new \User;
      $favorite = new \Users_directorio;
      
      $user->get_current();
      
      $favorite->user_id = $user->id;
      $favorite->directorio_id = $id;      
      $favorite->save_as_new();
    }
    
    // ----------------------------------------------------------------------
    
     public function add_favorite_provider(){
      
      $id = $this->_get('id');
      $user = new \User;
      $favorite = new \Users_directorio;
      $follow = new \Users_follow;
      $intelligence = new Intelligence;
      
      $user->get_current();
      
      $this->_datos->where('user_id', $id)->limit(1)->get();
      
      if($this->_datos->exists()){
        $favorite->directorio_id = $this->_datos->id;
        $favorite->user_id = $user->id;
        $favorite->save_as_new();
        
        $follow->user_id = $this->userinfo->id;
        $follow->user_follow_id = $this->_datos->user_id;
        $follow->allow_follow = true;
        $follow->created_on = datetime_now();
        
        if($follow->save()){      
          $intelligence->user_id = $this->_datos->user_id;
          $intelligence->users_follow_id = $follow->id;
          $intelligence->created_on = datetime_now();
          $intelligence->save();
        }
        
        $this->set_alert('Se ha agregado a sus favoritos satisfactoriamente!.', 'success');
      }else{
        $this->set_alert('No puede agregarlo como favorito, porque aún no ha sido publicado en los directorios.', 'error');
      }
    }
    
    // ----------------------------------------------------------------------
}