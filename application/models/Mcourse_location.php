<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mcourse_location
 *
 * @author dd
 */
class Mcourse_location extends CI_Model {
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        // load model
        $this->load->model(array('Mcourse'));
    }
    public function insert_entry($data)
    {
        $this->db->insert('course_location', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function getLocationByCourseID($id)
    {
        $this->db->where('course_id',$id);
        //$this->db->where('course_date >=', date('Y-m-d'));
        $query = $this->db->get('course_location');
        return $query->result_array();   
    }
    public function getAdminLocationByCourseID($id)
    {
        $this->db->where('course_id',$id);
        $query = $this->db->get('course_location');
        if ($query->num_rows() > 0) {
            return $query->result_array(); 
        }else{
            return FALSE;
        }        
    }
    public function getLocationByID($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('course_location');
        
        $return = $query->row_array();   
        $return['course'] = $this->Mcourse->getAdminCourseByID($return['course_id']); 
        return $return;
    }
    public function delete_location($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('course_location'); 
        return $this->db->affected_rows();
    }
    public function get_localtion_all()
    {
        $query = $this->db->get('course_location');
        return $query->result_array();   
    }
}
