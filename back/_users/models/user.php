<?php

class User extends DataMapper {

    public $model = 'user';
    public $table = 'users';
    public $has_one = array();
    public $has_many = array(
        'group' => array(
            'join_table' => 'users_groups',
            'auto_populate' => true
        ),
        'statu' => array(
            'auto_populate' => true
        ),
        'users_personal_info' => array(
            'auto_populate' => true
        ),
        'users_setting' => array(
            'auto_populate' => true
        ),
        'users_image' => array(
            'auto_populate' => true
        ),
        'users_song' => array(
            'auto_populate' => true
        ),
        'users_video' => array(
            'auto_populate' => true
        ),
        'users_photo' => array(
            'auto_populate' => true
        ),
        'users_show' => array(
            'auto_populate' => true
        ),
        'users_directorio' => array(
            'auto_populate' => true
        ),
        'users_clasificado' => array(
            'auto_populate' => true
        ),
        'users_follow' => array(
            'auto_populate' => true
        ),
        'intelligences_comment' => array(
          'auto_populate' => true  
        ),
        // ------
        'directorio',
        'audicion',
        'clasificado',
        'concierto' => array(
            'auto_populate' => true
        ),
        'notification' => array(
            'auto_populate' => true
        ),
        // Aplicaciones de recursos
        'audiciones_aplicacion' => array(
            'join_table' => 'users_audiciones_aplicaciones',
            'auto_populate' => true
        ),
        'clasificados_aplicacion' => array(
            'join_table' => 'users_clasificados_aplicaciones',
            'auto_populate' => true
        ),
        'comment' => array(
            'join_table' => 'users_comments',
            'auto_populate' => true
        ),
        'group' => array(
            'join_table' => 'users_groups'
        ),
        'band' => array(
            'auto_populate' => true
        ),
        'bands_instruments_user' => array(
            'auto_populate' => true
        ),
        'talent' => array(
            'join_table' => 'users_talents',
            'auto_populate' => true
        ),
        'intelligence' => array(
            'auto_populate' => true
        ),
        'musical_gender' => array(
            'join_table' => 'users_musical_genders',
            'auto_populate' => true
        )
    );
    public $validation = array(
        'username' => array(
            'label' => 'Nombre de usuario',
            'rules' => array('required', 'unique', 'trim', 'min_length' => 3, 'max_length' => 20, 'spaces')
        ),
        'first_name' => array(
            'label' => 'Nombre',
            'rules' => array('required')
        ),
        'last_name' => array(
            'rules' => array('required'),
            'label' => 'Apellido'
        ),
        'email' => array(
            'rules' => array('required', 'valid_email'),
            'label' => 'Email'
        ),
        'inshaka_url' => array(
            'rules' => array('required', 'unique', 'trim', 'min_length' => 3, 'max_length' => 20, 'spaces'),
            'label' => 'Dirección INSHAKA'
        ),
        'birthday' => array(
            'rules' => array('required', 'valid_date'),
            'label' => 'Fecha de nacimiento'
        )
    );

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------
    
    public function is_owner() {
        if(!$this->exists()){
            return false;
        }
        
        $ci =& get_instance();
        
        return (bool) (int) $this->id === (int) $ci->session->userdata('user_id');
    }
    
    // ----------------------------------------------------------------------
    
    public function get_current() {
        $ci = & get_instance();
        $user_id = $ci->ion_auth->user_id();

        return $this->get_by_id($user_id);
    }

    // ----------------------------------------------------------------------

    public function get_rating() {
        if (!$this->exists()) {
            return false;
        }

        $comments = new \Comment;

        $comments
                ->select('( (AVG(`sonido`) +  AVG(`actitud`) +  AVG(`presentacion`) + AVG(`profesionalismo`) ) / 4) as "ratings"', true)
                ->get_by_related($this);


        $ratings = number_format($comments->ratings, 1);

        return $ratings;
    }

    // ----------------------------------------------------------------------
    
    public function get_instruments_on_band($band_id) {
        $bands_instruments_user = new Bands_instruments_user;
        return $bands_instruments_user->where_related_bands_instrument('band_id', $band_id)->get_by_user_id($this->id);
        
    }

    // ----------------------------------------------------------------------
    
    public function get_provider($id=null) {
      $user = clone $this;
      $user->get_by_id($id);
      
      return $user->inshaka_url;
    }
    
    // ----------------------------------------------------------------------
    
    public function get_name($id = NULL) {
      $user = clone $this;
      $user->get_by_id($id);
      
      return $user->first_name.' '.$user->last_name;
    }
    
    // ----------------------------------------------------------------------
    
    public function get_url_inshaka($id=NULL) {
      $user = clone $this;
      $user->get_by_id($id);
      
      return $user->inshaka_url;
    }
    // ----------------------------------------------------------------------
    
    // Función de validación de espacios entre palabras
    function _spaces($field) {

        if (!empty($this->{$field})) {
          // Encontramos los espacios entre palabras
          $words = explode(" ", $this->{$field});
          $total = count($words);
          
          if($total >= 1){
            return FALSE;
          }          
          return TRUE;
        }
    }
    
    // ----------------------------------------------------------------------
    
    public function get_username($id = NULL) {
      $user = clone $this;
      $user->get_by_id($id);
      
      return $user->username;
    }
    
    // ----------------------------------------------------------------------
}