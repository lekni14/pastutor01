<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mzipcodes
 *
 * @author NiponRoom
 */
class Mzipcodes extends CI_Model {
    
    public function getZipcodes($id)
    {
        $this->db->where('district_code',$id);
        $query = $this->db->get('zipcodes');        
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
}
