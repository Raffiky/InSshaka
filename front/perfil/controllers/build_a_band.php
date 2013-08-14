<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
require_once APPPATH . 'third_party/recaptchalib' . EXT;

define('PUBKEY_RECAPTCHA', '6Le14tgSAAAAAJezoEMr7bXsZXAaDsTxeV-E4cWO');
define('PRIKEY_RECAPTCHA', '6Le14tgSAAAAANrzWwTuQBu46Mo142oNhiVda20E');

class Build_a_band extends Front_Controller {

    protected $user_area = true;
    private $_datos = null;

    public function __construct() {
        parent::__construct();

        // Mostrar header del perfil del usuario
        $this->show_header_perfil = true;

        $this->load->model(array('_bands/stage', '_bands/instrument', '_bands/musical_gender', '_bands/band', '_bands/bands_instrument', '_bands/bands_instruments_user'));

        $this->_datos = new \User;
        $this->_datos->get_current();
    }

    // ----------------------------------------------------------------------

    public function index() {
      
      $instrumentos = new Instrument;
      $band_instrument_user = new Bands_instruments_user;
      $players_band = clone $band_instrument_user;
      $perfil = new \Page;
  
      $this->_data['band_instrument_user'] = $band_instrument_user->get_band($this->_datos->id);
      $this->_data['players'] = $players_band;
      $this->_data['datos'] = $this->_datos->band;
      $this->_data['instrumentos'] = $instrumentos->get_for_select('Instrumento');
      $this->_data['is_band'] = $this->_datos->is_band;
      $this->_data['is_proveedor'] = $this->_datos->is_proveedor;
      $this->_data['usuario'] = $this->_datos;
      $this->_data['perfil'] = $perfil;
      
      $this->set_title('Mi Build a Band');

      return $this->build('mi_build_a_band/body');
    }

    // ----------------------------------------------------------------------

    public function eliminar($band_id = null) {

        $datos = & $this->_datos->band;

        $datos->get_by_id($band_id);
        
        if(!$datos->exists()){
            return show_404();
        }
        
        if($this->db->where('id', $datos->id)->delete('bands')){
            return redirect('perfil/build-a-band?delete='.$band_id);
        }
        
        return show_error('Hubo un error en la aplicación, intente de nuevo más tarde.', 500, 'Error al eliminar');
    }

    // ----------------------------------------------------------------------
    
    public function save_my_band() {
      $banda = new Band;
      $instrumento = new Instrument;
      $banda_instrumento = new Bands_instrument;
      $banda_instrumento_usuario = new Bands_instruments_user;
      
      $banda->get_by_name($this->_get('banda'));      
      $instrumento->get_by_id($this->_get('bands_instrument_id'));
      
      $id_banda = $banda->id;
      $id_instrumento = $instrumento->id;
      
      if(!empty($id_banda) && !empty($id_instrumento)) {
        $banda_instrumento
                ->where(array('band_id' => $id_banda, 'instrument_id' => $id_instrumento))
                ->get();
        
        if(!$banda_instrumento->exists()) {
          $banda_instrumento->instrument_id = $id_instrumento;
          $banda_instrumento->band_id = $id_banda;
          $banda_instrumento->save();
        }
        
        $instrumento_banda = $banda_instrumento->id;
        $user = $this->_datos->get_current();
        $usuario = $user->id;
        
        if(!empty($instrumento_banda) && !empty($usuario)) {
          $banda_instrumento_usuario->user_id = $usuario;
          $banda_instrumento_usuario->bands_instrument_id = $instrumento_banda;
          $banda_instrumento_usuario->created_on = datetime_now();
          $banda_instrumento_usuario->invitation_code = random_string('alnum', 40);
          $banda_instrumento_usuario->is_invited = false;
          $banda_instrumento_usuario->invitation_accepted = true;
          $banda_instrumento_usuario->save();          
        }
        
      }
            
      return redirect('perfil/build-a-band');
    }
    
    // ----------------------------------------------------------------------
    
    public function delete_member($id = NULL) {
      $bands_instrument_user = new Bands_instruments_user;
      $bands_instrument_user->where('id', $id)->get();
      
      if($bands_instrument_user->exists()){
        $bands_instrument_user->delete();
        $this->set_alert('¡Uno de los integrantes de la banda, ha sido eliminado!', 'success');
      }else {
        $this->set_alert('Hubo un error al tratar de eliminar uno de los integrantes de la banda. Inténtelo más tarde.', 'error');
      }
      
      return $this->index();
      
    }
    
    // ----------------------------------------------------------------------
    
    public function save_profile_band() {

      $profile  = new \Page;
      $banda_perfil = new \Band;      
      
      $banda = $this->_post('band_id');
      
      $profile->get_by_band_id($banda);
      $banda_perfil->get_by_id($banda);
      
      if($profile->exists()){
        $this->set_alert('El perfil para la banda '.$banda_perfil->name.', ya ha sido creado', 'error');
      }else{
        $profile->band_id = $banda;
        $profile->created_on = datetime_now();
        $profile->var = seo_name($banda_perfil->name);
        
        if ($profile->save()){
          $this->set_alert('¡El perfil para su banda '.$banda_perfil->name.', ha sido creado!', 'success');
        }else{
          $this->set_alert('Se ha producido un error. Inténtelo más tarde', 'error');
        }
      }     
      
      return $this->index();
    }
    
    // ----------------------------------------------------------------------
    
    public function delete_band_invitation(){
      // Recibimos las variables mediante GET
      $id = $this->_get('id');
      
      // Cargamos la tabla
      $band_instrument_user = new Bands_instruments_user($id);
      
      // Si existe la borramos
      if($band_instrument_user->exists()){
        $band_instrument_user->get_by_id($id)->delete();
      }
    }
    
    // ----------------------------------------------------------------------
}