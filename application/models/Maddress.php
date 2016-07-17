<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Maddress
 *
 * @author NiponRoom
 */
class Maddress extends CI_Model{
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        // load model
        $this->load->model(array('Mprovince','Msubdistrict','Mdistrict'));
    }
    public function insert_entry($data)
    {
        $this->db->insert('address', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function update_entry($data)
    {
        $this->db->where('id',$data['id']);
        $this->db->update('address',$data);
    }
    public function getAddress($id)
    {
        $this->db->where('member_id',$id);
        $query = $this->db->get('address');        
        if ($query->num_rows() > 0) {
            $return = $query->row_array();
            $return['province'] = $this->Mprovince->getProvinceByID($return['province_id']);
            $return['district'] = $this->Mdistrict->getDistrictByID($return['district_id']);
            $return['sub_district'] = $this->Msubdistrict->getSubdistrictByID($return['sub_district_id']);
            return $return;
        }else{
            return FALSE;
        }
        
    }
}
