<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mapplication_flow
 *
 * @author dd
 */
class Mapplication_flow extends CI_Model {
    //put your code here
    public function getApplication_flow_by_app($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('application_flow');
        if ($query->num_rows() > 0) {
            return  $query->row_array();
        } else {
            return false;
        }
    }
}
