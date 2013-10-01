<?php
/**
 * Description of mensajes
 *
 * @author Cristian Rivas
 */
class Mensajes extends Front_Controller {
  
  protected $user_area = true;
  
  public function __construct() {
    parent::__construct();
    // Mostrar header del perfil del usuario
    $this->show_header_perfil = true;
  }
  
  // ----------------------------------------------------------------------
  
  public function index(){
    // Cargamos los datos del usuario
    $user = new \User;
    $user->get_current();
    
    // Clonamos el usuario para cargar los datos
    $usuario =  clone $user;
    $photo = new \Users_photo;
    
    // Cargamos los mensajes directos
    $inbox = new \Inbox;
    $datos = $usuario
              ->select("id")
              ->distinct()
              ->where("id !=", $user->id)
              ->where_related($inbox, "user_id", $user->id)
              ->where_related($inbox, "ready", false)
              ->order_by_related($inbox, "created_on", "DESC")
              ->limit(15)
              ->get();
    
    if( $usuario->result_count() <= 15){
      $datos = $usuario
              ->select("id")
              ->distinct()
              ->where("id !=", $user->id)->where_related($inbox, "user_id", $user->id)
              ->order_by_related($inbox, "created_on", "DESC")
              ->limit(15)
              ->get();
    }

    $this->set_title("Mensajes directos de: ".$user->username);
    
    // Variables de datos para la vista
    $this->set_datos($datos);
    $this->_data["inbox"] = $inbox;
    $this->_data["photo"] = $photo;
    
    return $this->build("mis_mensajes/body");
  }
  
  // ----------------------------------------------------------------------
  
  public function update_message(){
    // Cargamos los datos del usuario
    $user = new \User;
    $user->get_current();
    
    $user_id = $this->_post("user_id");   
    $ok = false;
        
    // Cargamos los mensajes directos
    $inbox = new \Inbox;
        
    $inbox->where("user_id", $user_id)->get_by_related($user);

    if($inbox->exists()){
      $inbox->where(array("user_id" => $user_id, "ready" => false))->update("ready", true);
      $ok = true;
    }
    
    return $this->render_json($ok);
  }

  // ----------------------------------------------------------------------
  
  public function load_message($user_id = null){
    // Cargamos los datos del usuario
    $user = new \User;
    $user->get_current();
    
    // Clonamos el usuario para cargar los datos
    $usuario =  clone $user;
    
    // Cargamos los mensajes directos
    $inbox = new \Inbox;
    $inbox
            ->group_start()->where(array("user_id" => $user_id))->where_related($user)->group_end()
            ->or_group_start()->where("user_id", $user->id)->where_related($user, "id", $user_id)->group_end()
            ->order_by("created_on", "ASC")->get();
    
    // Variables de datos para la vista
    $this->set_datos($inbox);
    $this->_data["usuario"] = $usuario;
    $this->_data["data"] = $user;
    $this->_data["user_id"] = $user_id;
    
    return parent::view("mis_mensajes/message", false);
  }

  // ----------------------------------------------------------------------
  
  public function load_all(){
    // Cargamos los datos del usuario
    $user = new \User;
    $user->get_current();
    
    // Clonamos el usuario para cargar los datos
    $usuario =  clone $user;
    $photo = new \Users_photo;
    
    // Cargamos los mensajes directos
    $inbox = new \Inbox;
    
    // Clonamos los mensajes directos
    $inbox_clone = clone $inbox;
    
    $inbox->select("user_id")->distinct()
            ->where("ready", true)
            ->where_not_in_subquery("user_id", $inbox_clone->select("user_id")->where("ready", false)->where_related($user))
            ->limit(1000, 15)
            ->get_by_related($user);   
    
    // Variables de datos para la vista
    $this->set_datos($inbox);
    $this->_data["usuario"] = $usuario;
    $this->_data["photo"] = $photo;
    
    return parent::view("mis_mensajes/users", false);
  }
  
  // ----------------------------------------------------------------------
  
  public function send_message(){
    // Cargamos las variables recibidas mediante POST
    $user_id = $this->_post("user_id");
    $message = $this->_post("message");
    $created_on = datetime_now();
    
    // Cargamos la tabla de usuarios
    $user = new \User;
    
    // Creamos la expresión regular para separar los usuario
    $patron = "/@(_?)[a-z0-9]+(_?)([a-z0-9]?)+/i";
    if(preg_match_all($patron, $user_id, $coincidencias, PREG_OFFSET_CAPTURE)) {
      foreach ($coincidencias[0] as $coincide) {
        // Cargamos los datos a la tabla del inbox
        $inbox = new \Inbox;
        $inbox->message = $message;
        $inbox->created_on = $created_on;
        
        // Clonamos el usuario que envia el mensaje
        $user_self = clone $user;
        $user_self->get_current();
    
        // Verificamos si el usuario existe
        $user->where("username", trim($coincide[0], "@"))->get();
        
        // Si existe le envio el mensaje
        if($user->exists()){
          $inbox->user_id = $user_self->id;
          $inbox->save($user);
          
          // Cargamos la libreria de los mensajes
          $this->load->library('email');
          $this->email->clear();
          
          $this->_data = array(
              'user' => $user->first_name." ".$user->last_name,
              'user_send' => $user_self->first_name." ".$user_self->last_name,
              'message' => $message,
              'inshaka_url' => $user_self->inshaka_url
          );

          $html = parent::view('mis_mensajes/email');

          $this->email->from(SITEEMAIL, SITENAME);
          $this->email->to($user->email);

          $this->email->subject('Te han enviado un mensaje privado ');
          $this->email->message($html);
          $this->email->send();
          
          $this->set_alert("Tu mensaje se ha enviado satisfactoriamente", "success");
        }
      }   
    }
    
    return $this->index();
  }

  // ----------------------------------------------------------------------
  
  public function response_message(){  
    // Cargamos la tabla del inbox
    $inbox = new \Inbox;    
    $ok = false;
    $id = $this->_post("user_id");
    
    // Cargamos los datos del usuario que envia el mensaje
    $user = new \User;
    $user->get_current();
    
    // Clonamos el usuario
    $usuario = clone $user;
    $usuario->get_by_id($id);
    
    // Recibimos las variables mediante POST y agregamos aquellas que
    // cargan en el formulario
    $inbox->message = $this->_post("message");
    $inbox->created_on = datetime_now();
    $inbox->user_id = $user->id;
    
    // Guardamos el mensaje y lo relacionamos al usuario
    if($inbox->save($usuario)){
      // Cargamos la libreria de los mensajes
      $this->load->library('email');
      $this->email->clear();

      $this->_data = array(
          'user' => $usuario->first_name." ".$usuario->last_name,
          'user_send' => $user->first_name." ".$user->last_name,
          'message' => $this->_post("message"),
          'inshaka_url' => $user->inshaka_url
      );

      $html = parent::view('mis_mensajes/email');

      $this->email->from(SITEEMAIL, SITENAME);
      $this->email->to($usuario->email);

      $this->email->subject('Te han enviado un mensaje privado ');
      $this->email->message($html);
      $this->email->send();
      
      $ok = true;
    }
    
    return $this->render_json($ok);
  }
  
  // ----------------------------------------------------------------------
  
  public function delete_message(){
    // Recibimos las variables mediante post
    $id = $this->_post("id");
    $ok = false;
    
    // Cargamos el objeto
    $inbox = new \Inbox;
    $inbox->get_by_id($id);
    
    // Si existe lo eliminamos
    if($inbox->exists()){
      $ok = $inbox->get_by_id($id)->delete();      
    }
    
    return $this->render_json($ok);
  }
  
  // ----------------------------------------------------------------------
}