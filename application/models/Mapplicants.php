<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mapplicants
 *
 * @author dd
 */
class Mapplicants extends CI_Model {
    
    var $table = 'applicants';
    public function count_all_by_course($applicantion_id)
    {        
        $this->db->from($this->table);
        $this->db->where('application_id', $applicantion_id);
        return $this->db->count_all_results();
    }
    public function insert_entry($data)
    {
        $this->db->insert('applicants', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function getApplicantsByApp($app_id)
    {
        $this->db->where('application_id',$app_id);
        $query = $this->db->get('applicants');
        if ($query->num_rows() > 0) {
            return $query->result_array();          
        }else{
            return FALSE;
        } 
    }
    public function getCountapplicantsByApp($app_id)
    {
        $this->db->where('application_id',$app_id);
        $query = $this->db->get('applicants');
        if ($query->num_rows() > 0) {
            return $query->num_rows();          
        }else{
            return FALSE;
        } 
    }
    public function DeleteApplicantsById($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('applicants'); 
        return $this->db->affected_rows();
        
    }
}
