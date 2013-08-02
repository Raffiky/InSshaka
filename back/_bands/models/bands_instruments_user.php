<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Bands_instruments_user extends DataMapper {

    public $model = 'bands_instruments_user';
    public $table = 'bands_instruments_users';
    public $has_one = array(
        'user' => array(
            'auto_populate' => true
        ), 
        'bands_instrument' => array(
            'auto_populate' => true
        )
    );
    public $has_many = array(
       
    );
    public $validation = array();

    public function __construct($id = NULL) {
        parent::__construct($id);
    }

    // ----------------------------------------------------------------------
    
    public function invitation_current_user() {
      $this->where('is_invited', true);
      return $this;
    }
    
    // ----------------------------------------------------------------------
    
    public function get_invitation_current_user() {
      $user = new \User;
      $user->get_current();
      
      $this->invitation_current_user();
      $this->get_by_related($user);
      return $this;
    }
    
    // ----------------------------------------------------------------------
    
    public function get_band($user_id = null) {
      
      $sql = "SELECT DISTINCT cms_bands.name as banda, cms_bands.var as var, cms_bands.id as id, cms_users.first_name as first_name,
cms_users.last_name as last_name, cms_users.first_name,
cms_users.birthday as birthday FROM
            cms_bands_instruments_users
            INNER JOIN cms_bands_instruments ON cms_bands_instruments.id = cms_bands_instruments_users.bands_instrument_id
            INNER JOIN cms_bands ON cms_bands.id = cms_bands_instruments.band_id
            INNER JOIN cms_users ON cms_users.id = cms_bands_instruments_users.user_id
            WHERE
            cms_bands_instruments_users.user_id = ? AND
            cms_bands_instruments_users.invitation_accepted = ?";
      
      $parametros = array($user_id, 1); 
      
      return $this->query($sql, $parametros);
    }
    // ----------------------------------------------------------------------
    
    public function get_players_band($band_id = null){
      
      $datos = clone $this;
      $datos->where_related('bands_instruments', 'band_id', $band_id);
      $datos->where('invitation_accepted', true)->get();
      
      return $datos;    
    }
    
    // ----------------------------------------------------------------------
}