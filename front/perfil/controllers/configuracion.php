<?php

/**
 * Controlador para las configuraciones
 *
 * @author Cristian Rivas
 */
class Configuracion extends Front_Controller {
  
  protected $user_area = true;
  protected $show_header_perfil = true;


  public function __construct() {
    parent::__construct();
  }
  
  // ----------------------------------------------------------------------
  
  public function index($tab_content_active = 'correos'){
    // Cargando usuario
    $user = new \User;
    $user->get_current();
    // Cargando configuración de usuario
    $setting = new \Users_Setting;
    $setting->get_by_related($user);
    
    $this->set_title('Herramientas de configuración');
    $this->set_datos($setting);
    $this->_data['tab_content_active'] = $tab_content_active;
    
    return $this->build('configuracion/body');
  }
  
  // ----------------------------------------------------------------------
    
  public function save_settings(){
    // Cargando datos de usuario activo
    $user = new \User;
    $user->get_current();

    // Cargando configuración de usuario
    $settings = new \Users_Setting;
    $settings->get_by_related($user);

    if($settings->exists()){
      $ok = $settings->where('id', $settings->id)->update(array(
                'aplicacion_audiciones' => $this->_post('aplicacion_audiciones'),
                'audiciones_soy_fan' => $this->_post('audiciones_soy_fan'),
                'invitacion_bandas' => $this->_post('invitacion_bandas'),
                'bandas_soy_fan' => $this->_post('bandas_soy_fan'),
                'aplicacion_clasificados' => $this->_post('aplicacion_clasificados'),
                'clasificados_soy_fan' => $this->_post('clasificados_soy_fan'),
                'nuevo_fan' => $this->_post('nuevo_fan')
              ));
    }else{
      $settings->from_array($this->_post(null));      
      $ok = $settings->save($user);
    }
    
    if(!$ok){
      $this->set_alert($settings->error->string, 'error');
    }else{
      $this->set_alert('Los datos se guardaron satisfactoriamente', 'success');
    }

    return $this->index();

  }

  // ----------------------------------------------------------------------
  
  public function change_password(){
    $new = $this->_post('new');
    $new_confirm = $this->_post('new_confirm');
    
    // Cargando usuario
    $user = new \User;
    $user->get_current();
    
    $old_password = sha1($this->_post('old').$user->salt);
    
    if($old_password == $user->password){
      if($new == $new_confirm){
        $user->where('id', $this->userinfo->id)->update('password', sha1($new.$user->salt));
        $this->set_alert('Tu contraseña se ha cambiado satisfactoriamente.', 'success');
      }else{
        $this->set_alert('Las contraseñas no coinciden', 'error');
      }
    }else{
      $this->set_alert('La contraseña actual no coincide con la registrada.', 'error');
    }
    
    return $this->index('password');
    
  }
  
  // ----------------------------------------------------------------------
  
  public function change_email(){
    $old_email = $this->_post('old_email');
    $new_email = $this->_post('new_email');
    
    // Cargando usuario
    $user = new \User;
    $user->get_current();
    
    if($user->email == $old_email){
      $user->where('id', $this->userinfo->id)->update('email', $new_email);
      $this->set_alert('Tu email se ha cambiado satisfactoriamente. De ahora en adelante todos tus mensajes llegarán a tu nueva dirección de email.', 'success');
    }else{
      $this->set_alert('Tu email no ha sido cambiado, porque tu antiguo email no coincide con el registrado en InShaka.', 'error');
    }
    
    return $this->index('email');
  }
  
  // ----------------------------------------------------------------------
}

