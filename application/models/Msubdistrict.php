<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Msubdistrict
 *
 * @author NiponRoom
 */
class Msubdistrict extends CI_Model {
    
    public function getSubDistrict($id)
    {
        $this->db->where('AMPHUR_ID',$id);
        $query = $this->db->get('district');        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function getSubdistrictByID($id)
    {
        $this->db->where('DISTRICT_CODE',$id);
        $query = $this->db->get('district');        
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
}
