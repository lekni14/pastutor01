<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mstorage
 *
 * @author dd
 */
class Mstorage extends CI_Model {
    
    public function getFileByFID($id,$fid)
    {
        $this->db->where('tid',$fid);
        $this->db->where('fid',$id);
        $query = $this->db->get('storage');
        if($query->num_rows() > 0){
            return $query->result_array();   
        }else{
            return FALSE;
        }
        
    }
    public function getFileByID($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('storage');
        if($query->num_rows() > 0){
            return $query->row_array();   
        }else{
            return FALSE;
        }
        
    }
    public function insert_entry($data)
    {
        $this->db->insert('storage', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    public function delete_storage($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('storage'); 
        return $this->db->affected_rows();
    }
}
