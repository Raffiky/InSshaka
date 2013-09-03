<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Audiciones extends Front_Controller {
    
    protected $user_area = false;

    private $_title = 'Nuevas audiciones', $_datos = null, $_page = 1;

    public function __construct() {
        parent::__construct();

        $this->_datos = new Audicion;

        if ($this->_get('order')) {
            $this->_datos->order_by($this->_get('order'), $this->_get('type'));
        }
    }

    // ----------------------------------------------------------------------

    public function index($seccion = 'audiciones_individual') {
        $genders = new Musical_gender();
        
        $this->_data['genders'] = $genders->get_for_select('Género musical');
        $this->_data['es_usuario'] = $this->is_usuario();

        if ($seccion == 'audiciones_individual') {
            // Solo las audiciones que tenga fecha de cierre menor a la fecha actual
            $this->_datos->only_actives();
            $this->_datos->tipo_audicion();
            $talents = new Talent;
            $this->_data['talents'] = $talents->get_for_select('Seleccione...');
            $this->_datos->get();
        }
        
        if ($seccion == 'audiciones_banda') {
            // Solo las audiciones que tenga fecha de cierre menor a la fecha actual
            $this->_datos->only_actives();
            $this->_datos->tipo_audicion('Banda'); 
            $this->_datos->get();
        }
        
        
        $this->set_datos($this->_datos);     
        
        
        $this->_data['content'] = parent::view($seccion);
        $this->_data['seccion'] = $seccion;
        

        $this->set_title($this->_title);

        return $this->build();
    }

    // ----------------------------------------------------------------------

    public function page($num_page = 1) {
        $this->_page = $num_page;
        return $this->index();
    }
    
    // ----------------------------------------------------------------------
    
    public function buscar($page = 1) {

        if ($this->_get(null)) {
            foreach ($this->_get(null) as $field => $get) {
                if (empty($get)) {
                    switch ($field) {
                        case 'ciudad':
                           $this->_datos->like('ciudad', (string) $get)->get();                            
                            break;
                        case 'numero_aplicaciones' :
                            $this->_datos->where('numero_aplicaciones', (int) $get)->get();
                            break;
                        case 'talento':
                            $this->_datos->where('talent_id', (int) $get)->get();                            
                            break;
                        default:
                            $this->_datos->like($field, $get)->get();
                            break;
                    }
                }
            }
//            
//            echo $this->_datos->get_sql();
//            exit;
          

            $this->_datos->get_paged($page, 10);
            
            $this->_count = $this->_datos->count_distinct();
        }


        return $this->index();
    }    
    
    // ----------------------------------------------------------------------
    
    public function buscar_band($page = 1) {
      
      $audiciones = new Audicion;

        if ($this->_get(null)) {
            foreach ($this->_get(null) as $field => $get) {
                if (!empty($get)) {
                    switch ($field) {
                        case 'ciudad':
                           $audiciones->like('ciudad', $get);                            
                            break;
                        case 'musical_gender_id':
                            $audiciones->where('musical_gender_id', $get);
                            break;
                        case 'numero_aplicaciones' :
                            $audiciones->where('numero_aplicaciones', $get);
                            break;
                        default:
                            $audiciones->like($field, $get);
                            break;
                    }
                }
            }
//            
//            echo $this->_datos->get_sql();
//            exit;
          
            $audiciones->where('tipo_audicion', 'Banda')->get_paged($page, 10);
            $audiciones->check_last_query();
            
            $this->_count = $audiciones->count_distinct();
        }


        return $this->index('audiciones_banda');
    }    
    
    // ----------------------------------------------------------------------

    public function crear() {
        $this->_title = 'Crear audición';
        //$q = $this->db->get('medicos');
        $talents = new Talent;

        $this->_data['talents'] = $talents->get_for_select('Seleccione...');
        
        $this->_data['ciudades']=$this->_datos->__get('cms_ciudades');
        $this->_data['edit_mode'] = false;
        
        return $this->index('crear_audicion');
    }

    // ----------------------------------------------------------------------

    public function editar($id = null) {
        $talents = new Talent;
        $this->_datos->get_by_id($id);
        $this->_data['talents'] = $talents->get_for_select('Seleccione...');
        
        if(!$this->_datos->exists()){
            return show_404();
        }
        
        $this->_data['edit_mode'] = true;
        return $this->index('crear_audicion');
    }

    // ----------------------------------------------------------------------

    public function save($id = null) {
        $datos =& $this->_datos;
        
        if(!empty($id)){
            $datos->get_by_id($id);
            
            if(!$datos->exists()){
                return show_404();
            }
        }
        
        $edit_mode = (bool) $this->_post('edit_mode');

        if ($this->_post(null)) {

            $datos->from_array($this->_post(null));
            $dias_publicacion = $this->_post('dias_publicacion');
            if (!empty($dias_publicacion)) {
                $fecha_inicial = $this->_post('fecha_inicio');

                if (!empty($fecha_inicial)) {
                    $fecha_inicial = new DateTime($fecha_inicial);
                    $fecha_cierre = clone $fecha_inicial;
                    $fecha_cierre->modify('+' . $dias_publicacion . ' days');
                    $datos->fecha_cierre = $fecha_cierre->format(DATE_MYSQL);
                }
            }

            $user = new User;
            $user->get_current();


            $datos->created_on = datetime_now();
            
            if($this->_post('tipo_audicion') == 'Individual' ){
              $datos->validation['talents_id'] = array(
                  'label' => 'Talento',
                  'rules' => array('required_select' )
              );
            }

            $ok = $datos->save($user);


            if (!$ok) {
                $this->set_alert($datos->error->string, 'error');
            } else {
                $datos->var = seo_name($datos->titulo);
                $datos->save();
                
                $intelligence = new Intelligence;
                $intelligence->user_id = $user->id;
                $intelligence->audicion_id = $datos->id;
                $intelligence->created_on = datetime_now();
                $intelligence->save();

                // Si se sube una imagen, ejecutar el upload
                // Si no, lanzar el mensaje de success
                if (!empty($_FILES['imagen']['name'])) {

                    $path = UPLOADSFOLDER . 'audiciones';

                    if (!is_dir($path)) {
                        @mkdir($path);
                        @chmod($path, 0777);
                    }

                    $config['upload_path'] = $path;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['encrypt_name'] = true;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('imagen')) {
                        $this->set_alert('Se guardo la información pero se presentaron los siguientes errores subiendo la imagen de perfil: ' . $this->upload->display_errors(), 'error');
                    } else {

                        // Borrando imagen actual
                        if (!empty($datos->imagen)) {
                            @unlink(UPLOADSFOLDER . $datos->imagen);
                        }

                        // Limpiando el path del logo para guardarlo
                        $datos_image = $this->upload->data();
                        $path = str_replace(UPLOADSFOLDER, '', $datos_image['full_path']);

                        $config['source_image'] = $datos_image['full_path'];
                        $config['master_dim'] = 'width';
                        $config['new_image'] = $datos_image['full_path'];
                        $config['width'] = 200;
                        $config['height'] = 280;

                        $this->load->library('image_lib', $config);

                        if (!$this->image_lib->resize()) {
                            $this->set_alert('Información guardada pero hubo un error al remasterizar la imagen. Verifique que la imagen tenga las medidas recomendadas', 'error');
                        } else {
                            $datos->imagen = $path;
                            if ($datos->save()) {
                                $this->set_alert('Información e imagen guardados correctamente.', 'success');
                            } else {
                                $this->set_alert('Información guardada pero hubo un error al guardar la imagen.', 'error');
                            }
                        }
                        
                        if(!$edit_mode){
                            return redirect('perfil/audiciones/');
                        }
                    }
                } else {
                    $this->set_alert('Información editada correctamente.', 'success');
                }
            }
        }

        if($edit_mode){
            return $this->editar($id);
        }
        
        return $this->crear();
    }

    // ----------------------------------------------------------------------

    public function detalle($audicion_id) {

        $this->_datos->get_by_id($audicion_id);
        
        $talents = new Talent;        
        $usuario = new \User;
        $mis_band = new \Band;
        $user = clone $usuario;
        $musical_gender = new \Musical_gender;
        
        $true = null;
        $ok = null;
        
        $user->get_current();
        
        $usuario->where_related('talent', 'id', $this->_datos->talent_id)->get_current();
        
        $mis_band->where('user_id', $user->id);
        $mis_band->group_start();
        $mis_band->where_related('musical_genders', 'id', $this->_datos->musical_gender_id);
        $mis_band->or_where('sub_uno_musical_gender_id', $this->_datos->musical_gender_id);
        $mis_band->or_where('sub_dos_musical_gender_id', $this->_datos->musical_gender_id)->group_end()->get();
        
        if($this->_datos->tipo_audicion == 'Banda'){
  
            if($mis_band->exists()){
              $true = true;
            }
        }
        
        if($this->_datos->tipo_audicion == 'Individual'){                
          if($usuario->exists()){
            $ok = true;
          }      
        }

        if (!$this->_datos->exists()) {
            return show_404();
        }

        // Actualizando el número de aplicaciones de la audición
        $this->_datos->total_aplicaciones = $this->_datos->audiciones_aplicacion->count();
        $this->_datos->save();

        $fecha_inicio = new DateTime($this->_datos->fecha_inicio);
        $fecha_cierre = new DateTime($this->_datos->fecha_cierre);
        $hoy = new DateTime('now');
        
        if($hoy <= $fecha_inicio) {
          if($ok == true or $true == true){          
            $diff = $hoy->diff($fecha_inicio);
            $diferencia = "Faltan ".$diff->format('%a día(s) y %h hora(s)')." para poder aplicar";
          }else{
            $diferencia = "No puedes aplicar a esta audición, porque no tienes el talento requerido.";
          }
        }else{
          if($ok == true or $true == true){
            $diferencia = " ";
          }else{
            $diferencia = "No puedes aplicar a esta audición, porque no tienes el talento requerido.";
          }
        }
        
        $this->_data['user'] = $this->_datos->user->first_name.' '.$this->_datos->user->last_name; 
        $this->_data['can_apply'] = $fecha_inicio <= $hoy && $ok == true && $fecha_cierre >= $hoy ;
        $this->_data['can_apply_band'] = $mis_band ;
        $this->_data['dias_restantes'] = $diferencia;
        $this->_data['is_owner'] = $this->userinfo->username == $this->_datos->user->username;
        $this->_data['talento'] = $talents->get_talent($this->_datos->talent_id);
        $this->_data['banda'] = $musical_gender->get_by_id($this->_datos->musical_gender_id);
        $this->_data['mis_bandas'] = $mis_band;

        $this->set_datos($this->_datos)->set_title('Audición: ' . $this->_datos->titulo);

        return $this->build('detalle');
    }

    // ----------------------------------------------------------------------

    public function aplicar() {
        $user = new User;
        $user->get_current();
      
        $audicion_id = (int) $this->_post('audicion_id');
        $presentacion = $this->_post('presentacion') ? (string) nl2br($this->_post('presentacion', true)) : null;

        $this->_datos->get_by_id($audicion_id);

        if (!$this->_datos->exists() OR empty($audicion_id)) {
            return show_404();
        }

        $audicion_aplicacion = new Audiciones_aplicacion;

        $audicion_aplicacion->presentacion = $presentacion;
        $audicion_aplicacion->created_on = datetime_now();
        $audicion_aplicacion->user_id = $user->id;


        if ($audicion_aplicacion->save($this->_datos)) {
            if ($audicion_aplicacion->save_user($this->_datos->user)) {
              // Cargando interacción
              $intelligence = new \Intelligence;
              $intelligence->audiciones_aplicacion_id = $audicion_aplicacion->id;
              $intelligence->save($user);
              
              // Cargando notificación
              $notification = new \Notification;
              $notification->user_id = $audicion_aplicacion->audicion->user_id;
              $notification->save($intelligence);
              
              if ($this->_send_email($this->_datos->user, $presentacion)) {
                $message = '¡Gracias por aplicar a esta audición!';
              } else {
                $message = 'Has aplicado correctamente pero hubo un error al informar al dueño de la misma.';
              }
              $this->_datos->total_aplicaciones = $this->_datos->total_aplicaciones++;

              $this->_datos->save();
            }
        }

        $this->_data['message'] = $message;

        return $this->set_title('Aplicar a la audición: ' . $this->_datos->titulo)->build('aplicacion_audicion');
    }

    // ----------------------------------------------------------------------

    public function _send_email($user_owner, $presentacion = null) {
        $user_apply = new User;
        $user_apply->get_current();
        
        $this->load->library('email');

        $this->email->clear();

        $this->_data = array(
            'user_owner' => $user_owner,
            'user_apply' => $user_apply,
            'presentacion' => $presentacion,
            'datos' => $this->_datos,
            'urls' => $this->urls
        );

        $html = parent::view('emails/aplicar');

        $this->email->from(SITEEMAIL, SITENAME);
        $this->email->to($user_owner->email);

        $this->email->subject($user_apply->username . ' ha aplicado a la audición: ' . $this->_datos->titulo);
        $this->email->message($html);


        return $this->email->send();
    }
    
    // ----------------------------------------------------------------------

    public function applyband() {
        $user = new User;
        $user->get_current();
      
        $audicion_id = (int) $this->_get('audicion_id');
        $presentacion = $this->_get('presentacion') ? (string) nl2br($this->_get('presentacion', true)) : null;
        $banda_id = (int) $this->_get('band_id');
        
        $band = new \Band;
        $band->get_by_id($banda_id);

        $this->_datos->get_by_id($audicion_id);

        if (!$this->_datos->exists() OR empty($audicion_id)) {
            return show_404();
        }

        $audicion_aplicacion = new Audiciones_aplicacion;

        $audicion_aplicacion->presentacion = $presentacion;
        $audicion_aplicacion->created_on = datetime_now();
        $audicion_aplicacion->user_id = $user->id;


        if ($audicion_aplicacion->save($this->_datos)) {
            if ($audicion_aplicacion->save_user($this->_datos->user)) {
                // Cargando interacción
              $intelligence = new \Intelligence;
              $intelligence->audiciones_aplicacion_id = $audicion_aplicacion->id;
              $intelligence->save($user);
              
              // Cargando notificación
              $notification = new \Notification;
              $notification->user_id = $audicion_aplicacion->audicion->user_id;
              $notification->save($intelligence);
              
                if ($this->_send_email_page($band->name, $band->page->var, $this->_datos->user, $presentacion)) {
                    $message = '¡Gracias por aplicar a está audición!';
                } else {
                    $message = 'Has aplicado correctamente pero hubo un error al informar al dueño de la misma.';
                }
                $this->_datos->total_aplicaciones = $this->_datos->total_aplicaciones++;
                
                $this->_datos->save();
            }
        }

        $this->_data['message'] = $message;
        
        $this->set_title('Aplicar a la audición: ' . $this->_datos->titulo);
        
        $this->set_alert('¡Gracias por aplicar a está audición!', 'success');

    }

    // ----------------------------------------------------------------------
    
    public function _send_email_page($band, $url_band, $user_owner, $presentacion = null) {
        $user_apply = new User;
        $user_apply->get_current();
        
        $this->load->library('email');

        $this->email->clear();

        $this->_data = array(
            'user_owner' => $user_owner,
            'user_apply' => $user_apply,
            'band' => $band,
            'url_band' => $url_band,
            'presentacion' => $presentacion,
            'datos' => $this->_datos,
            'urls' => $this->urls
        );

        $html = parent::view('emails/aplicar_band');

        $this->email->from(SITEEMAIL, SITENAME);
        $this->email->to($user_owner->email);

        $this->email->subject($user_apply->username . ' ha aplicado a la audición: ' . $this->_datos->titulo);
        $this->email->message($html);


        return $this->email->send();
    }
    
    // ----------------------------------------------------------------------

}