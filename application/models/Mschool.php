<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mschool
 *
 * @author NiponRoom
 */
class Mschool extends CI_Model {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        // load model
        $this->load->model(array('Mprovince'));
    }
    public function getSchool()
    {
        $query = $this->db->get('school');        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function getSchoolByProvince($id)
    {
        $this->db->where('PROVINCE_ID',$id);
        $query = $this->db->get('school');        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    public function getSchoolByID($id)
    {
        $this->db->where('school_id',$id);
        $query = $this->db->get('school');        
        if ($query->num_rows() > 0) {
            $return = $query->row_array();
            $return['province'] = $this->Mprovince->getProvinceByID($return['PROVINCE_ID']);
            return $return;
        } else {
            return false;
        }
    }
}
