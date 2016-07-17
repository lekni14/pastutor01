<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mdistrict
 *
 * @author NiponRoom
 */
class Mdistrict extends CI_Model {
    
    public function getDistrict($id)
    {
        $this->db->where('PROVINCE_ID',$id);
        $query = $this->db->get('amphur');        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function getDistrictByID($id)
    {
        $this->db->where('AMPHUR_ID',$id);
        $query = $this->db->get('amphur');        
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
}
