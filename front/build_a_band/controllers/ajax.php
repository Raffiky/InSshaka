<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Ajax extends Front_Controller {

    protected $user_area = false;

    public function __construct() {
        parent::__construct();
    }

    // ----------------------------------------------------------------------

    public function save_band($band_id = null) {
        $datos = new \Band($band_id);
        $user = new \User;
        $user->get_current();
        $edit_mode = true;

        $users = $this->_post('users');

        if (!$datos->exists()) {
            $datos->created_on = datetime_now();
            $this->_data['continue_url'] = site_url('perfil/build-a-band');
            $edit_mode = true;
        }
        

        $datos->from_array($this->_post(null));

        $datos->var = seo_name($this->_post('name'));

        $ok = $datos->save($user);

        if (true === $ok) {
            $intelligence = new Intelligence;
            $intelligence->user_id = $user->id;
            $intelligence->band_id = $datos->id;
            $intelligence->created_on = datetime_now();
            $intelligence->save();
            
            if (!empty($users)) {

                $bands_instrument = new \Bands_instrument;
                $bands_instruments_user = new \Bands_instruments_user;

                $instrument = new \Instrument;
                $user_instrument = new \User;

                // Guardando los usuarios e instrumentos
                foreach ($users as $instrument_id => $users_instruments) {
                    $instrument->get_by_id($instrument_id);


                    $bands_instrument->where(array('instrument_id' => $instrument->id))->get_by_related($datos);



                    if (!$bands_instrument->exists()) {
                        $bands_instrument->save(array($instrument, $datos));
                    }

                    // Guardando los usuarios de cada instrumento
                    foreach ($users_instruments as $user_id) {
                        $user_instrument->get_by_id($user_id);

                        $bands_instruments_user->where(array('user_id' => $user_instrument->id, 'bands_instrument_id' => $bands_instrument->id))->get();

                        // Si el usuario no existe para el instrumento, crear y ejecutar funciones
                        if (!$bands_instruments_user->exists()) {
                            $bands_instruments_user->created_on = datetime_now();
                            $bands_instruments_user->invitation_code = random_string('alnum', 40);
                            $bands_instruments_user->is_invited = true;

                            if ($bands_instruments_user->save(array($user_instrument, $bands_instrument))) {

                                // Envio de invitación via E-mail
                                $this->_send_email($bands_instruments_user->invitation_code, $user_instrument->email, ($user_instrument->first_name . ' ' . $user_instrument->last_name), sprintf($this->urls->inshaka_url, $user->inshaka_url), ($user->first_name . ' ' . $user->last_name), $datos->name, $instrument->name);
                                
                            }
                        }

                        $bands_instruments_user->clear();
                    }
                    $bands_instrument->clear();
                    $instrument->clear();
                }

                $message_success = 'La banda fue creada correctamente. Ahora estamos redirigiendo a todas tus bandas...';

                if ($edit_mode) {
                    $message_success = 'Cambios guardados en la banda.';
                }
            } else {

                // Si estamos en editar y no sube ningún usuario
                // Eliminar todos los registros para limpieza
                if ($edit_mode) {
                    if ($datos->exists()) {
                        $this->db->where('band_id', $datos->id)->delete('bands_instruments');
                    }
                }

                $message_success = 'La banda (sin integrantes) fue creada correctamente. Ahora estamos redirigiendo a todas tus bandas...';

                if ($edit_mode) {
                    $message_success = 'Cambios (sin integrantes) guardados en la banda.';
                }
            }


            $this->set_alert($message_success, 'success');
        } else {
            $this->set_alert($datos->error->string, 'error');
        }

        return $this->render_json($ok);
    }

    // ----------------------------------------------------------------------

    public function _send_email($code, $email_invitado, $nombre_invitado, $url_creador, $nombre_creador, $nombre_banda, $instrumento) {
        $url_accept = site_url('build-a-band/accept-invitation/' . $code);
        $url_decline = site_url('build-a-band/decline-invitation/' . $code);
        
        $user_apply = new User;
        $user_apply->get_current();

        $this->load->library('email');

        $this->email->clear();

        $this->_data = array(
            'message' => $this->_post('message'),
            'email_invitado' => $email_invitado,
            'nombre_creador' => $nombre_creador,
            'nombre_banda' => $nombre_banda,
            'nombre_invitado' => $nombre_invitado,
            'url_creador' => $url_creador,
            'instrumento' => $instrumento,
            'url_accept' => $url_accept,
            'url_decline' => $url_decline
        );

        $html = parent::view('emails/invitacion_band');


        $this->email->from(SITEEMAIL, SITENAME);
        $this->email->to($email_invitado);

        $this->email->subject($nombre_creador . ' te ha invitado a su banda: ' . $nombre_banda . '. En el ' . $instrumento);
        $this->email->message($html);


        return $this->email->send();
    }

    // ----------------------------------------------------------------------

    public function search_users() {

        $datos = new \User;
        $info_personal = new \Users_personal_info;
        $return = array();
        $params = array();

        $keyword = $this->_get('s');
        
        $num_conciertos = $this->_get('num_conciertos') ? $this->_get('num_conciertos') : $keyword;
        $nivel_experiencia = $this->_get('niv_experiencia') ? $this->_get('niv_experiencia') : $keyword;
        $experiencia = $this->_get('experiencia') ? $this->_get('experiencia') : $keyword;
        $city = $this->_get('city') ? $this->_get('city') : $keyword;
        $necesitas_band = $this->_get('necesitas_band') ? $this->_get('necesitas_band') : $keyword;
        $users = $this->_get('_users');
        $instrument = $this->_get('talent_id') ? explode(":",$this->_get('talent_id')) : $keyword;
        
        // Cargamos la categoría del instrumento
        $talents_category = new \Talents_category;
        $talents_category->get_by_name($instrument[0]);
        
        if (!empty($num_conciertos)) {
          $params['numero_conciertos'] = $num_conciertos;
        }
        
        if (!empty($necesitas_band)) {
          $params['necesitas_band'] = $necesitas_band;
        }
        
        if (!empty($nivel_experiencia)) {
          $params['nivel_experiencia'] = $nivel_experiencia;
        }
        
        if (!empty($experiencia)) {
          $params['anos_experiencia'] = $experiencia;
        }
        
        if (!empty($city)) {
          $params['city'] = $city;
          $info_personal->ilike_related('users', 'city', $city);
        }

        if (!empty($users) && @is_array($users)) {
            $info_personal->where_related('users', 'is_proveedor', false);
            $info_personal->where_related('users', 'is_band', false);
        }

        if (!empty($params)) {
          $info_personal
                  ->ilike($params)
                  ->where_in_related_subquery('users', 'id', $datos->select("id")->where_related_subquery('talent', "id", $datos->talent
                          ->select('id')
                          ->where('name', $instrument[1])
                          ->where_related('talents_categories', 'id', $talents_category->id)))
                  ->get();
            
            if ($info_personal->exists()) {
              foreach ($info_personal as $dato) {
                array_push($return, $dato);
              }
            }
        }
        
        $this->_data['datos'] = $return;
        $this->_data['user'] = $datos;
        
        echo parent::view('ajax/search_users');
    }
    
    // ----------------------------------------------------------------------

    public function search_users_inshaka() {

        $datos = new \User;
        $return = array();
        $params = array();
        
        $keyword = $this->_get('s');

        $username = $this->_get('username') ? $this->_get('username') : $keyword;
        $email = $this->_get('email') ? $this->_get('email') : $keyword;
        $first_name = $this->_get('first_name') ? $this->_get('first_name') : $keyword;
        $last_name = $this->_get('last_name') ? $this->_get('last_name') : $keyword;
        $users = $this->_get('_users');

        if (!empty($username)) {
            $params['username'] = $username;
        }

        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $params['email'] = $email;
        }

        if (!empty($first_name)) {
            $params['first_name'] = $first_name;
        }

        if (!empty($last_name)) {
            $params['last_name'] = $last_name;
        }

        if (!empty($users) && @is_array($users)) {
            $datos->where_not_in('id', $users);
        }

        if (!empty($params)) {
            $datos->ilike($params)->get();
            
            if ($datos->exists()) {
              foreach ($datos as $dato) {
                $dato->group->get();
                if (in_array($dato->group->name, array('usuarios', 'bandas'))) {
                  array_push($return, $dato);
                }
              }
            }
        }
        
        $this->set_datos($return);
        
        echo parent::view('ajax/search_users_inshaka');
    }

    // ----------------------------------------------------------------------
    
    public function send_email_guest() {
        $email_invitado = $this->_get('email_invitado');
        $url_creador = $this->_get('url_creador');
        $nombre_creador = $this->_get('nombre_creador');
        $nombre_banda = $this->_get('nombre_banda');
        
        $this->load->library('email');

        $this->email->clear();

        $this->_data = array(
            'message' => $this->_post('message'),
            'email_invitado' => $email_invitado,
            'nombre_creador' => $nombre_creador,
            'nombre_banda' => $nombre_banda,
            'url_creador' => $url_creador
        );

        $html = parent::view('emails/invitacion_band_guest');


        $this->email->from(SITEEMAIL, SITENAME);
        $this->email->to($email_invitado);

        $this->email->subject($nombre_creador . ' te ha invitado a su banda: ' . $nombre_banda);
        $this->email->message($html);
        
        if($this->email->send()){
          $return = "envio de mail satisfactorio";
        }else{
          $return = "hubo un error al enviar el mail";
        }

       echo $return;
    }

    // ----------------------------------------------------------------------
}
