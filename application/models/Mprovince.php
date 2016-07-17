<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mprovince
 *
 * @author NiponRoom
 */
class Mprovince extends CI_Model {
    
    public function getProvince()
    {
        $query = $this->db->get('province');        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function getProvinceByID($id)
    {
        $this->db->where('PROVINCE_ID',$id);
        $query = $this->db->get('province');        
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    public function getProvinceByGeo()
    {
        $this->db->where('GEO_ID',3);
        $query = $this->db->get('province');        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}
