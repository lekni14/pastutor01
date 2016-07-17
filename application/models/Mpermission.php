<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mpermission
 *
 * @author dd
 */
class Mpermission extends CI_Model {
    
    public function getPermission($id)
    {
        $this->db->where('id',$id);   
        $query = $this->db->get('permission');
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }  
    }
}
