<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Band extends DataMapper {

    public $model = 'band';
    public $table = 'bands';

    public $has_one = array(
        'musical_gender' => array('auto_populate' => true),
        'user',
        'page' => array(
            'auto_populate' => true
        )
    );
    
    public $has_many = array(
        'bands_instrument' => array(
            'auto_populate' => true
        ),
        'intelligence' => array(
            'auto_populate' => true
        )
    );
    
    public $validation = array(
        'name' => array(
            'label' => 'Nombre',
            'rules' => array('required', 'unique')
        ),
        'city' => array(
            'label' => 'Ciudad',
            'rules' => array('required')
        ),
        'musical_gender_id' => array(
            'label' => 'Género músical',
            'rules' => array('required_select')
        )
    );

    public function __construct($id = NULL) {
        parent::__construct($id);
    }
    
    // ----------------------------------------------------------------------
    
    public function get_all_current_user() {
        $user = new \User;
        $user->get_current();
    
        
        $this->get_by_related($user);
        
        return $this;
    }

    // ----------------------------------------------------------------------
    
    public function get_name_gender($genero = "Genero Principal", $user = NULL) {
      $banda = clone $this;
      $genero_musical = new \Musical_gender;
   
      $banda->get_by_user_id($user);
      
      switch ($genero) {
        case "Genero Principal" :
          $return = $banda->musical_gender->name;
          break;
        case "Subgenero uno":
          $genero_musical->get_by_id($banda->sub_uno_musical_gender_id);
          $return = $genero_musical->name;
          break;
        case "Subgenero dos":
          $genero_musical->get_by_id($banda->sub_dos_musical_gender_id);
          $return = $genero_musical->name;
          break;
        default :
          $return = "Sin definir";
          break;
      }
            
      return $return;
    }
    
    // ----------------------------------------------------------------------
}