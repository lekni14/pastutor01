<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mmember_level
 *
 * @author dd
 */
class Mmember_level extends CI_Model{
    
    var $table = 'member_level';   
    public function get_by_id($id) {
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        return $query->row_array();
         
    }
            
}
