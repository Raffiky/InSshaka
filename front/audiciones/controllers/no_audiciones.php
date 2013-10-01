<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Cristian Rivas
 */
class No_audiciones extends Front_Controller {
   
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
//        $this->user_area = false;
        $genders = new Musical_gender();
        $seccion = str_replace("-", "_", $seccion);
        
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

}