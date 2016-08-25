<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mcourse
 *
 * @author dd
 */
class Mcourse extends CI_Model {
    
    var $table = 'course';  
    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        // load model
        $this->load->model(array('Mstorage','Mcourse_location','Mapplication'));
    }
    public function count_all_by_date()
    {
        $this->db->where('reg_end_date >=', date('Y-m-d'));
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function count_all_by_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function insert_entry($data)
    {
        $this->db->insert('course', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function update_entry($data)
    {
        $this->db->where('id',$data['id']);
        $this->db->update('course', $data);
    }
    public function delete_($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('course'); 
        $this->db->where('course_id',$id);
        $this->db->delete('course_location'); 
        return $this->db->affected_rows();
    }    
    public function getCourse()
    {
        $this->db->order_by('course.id','DESC');
        $this->db->where('active',1);
        //$this->db->join('course_location','course_location.course_id=course.id');
        //$this->db->where('reg_end_date >', date('Y-m-d'));
        $query = $this->db->get('course'); 
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            foreach ($query->result_array() as $key => $value) {
                $return[$key]['storage'] = $this->Mstorage->getFileByFID($value['id'],1);            
                $return[$key]['location'] = $this->Mcourse_location->getLocationByCourseID($value['id']);            
            }
            return $return;
        } else {
            return false;
        }
        
       
    }
    public function getCourseByID($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('course');
        if ($query->num_rows() > 0) {
            $return = $query->row_array();  
            $return['storage'] = $this->Mstorage->getFileByFID($id,1);            
            $return['location'] = $this->Mcourse_location->getLocationByCourseID($id);  
            return $return;
        }else{
            return FALSE;
        }
    }
    public function getAdminCourseByID($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('course');
        if ($query->num_rows() > 0) {
            $return = $query->row_array();  
            $return['storage'] = $this->Mstorage->getFileByFID($id,1);            
            $return['location'] = $this->Mcourse_location->getAdminLocationByCourseID($id);  
            return $return;
        }else{
            return FALSE;
        }
    }
    public function getAdminCourse_tAll()
    { // รวมโครงการทั้งหมด จาก location
        $this->db->order_by('id','DESC');
        $query = $this->db->get('course'); 
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            foreach ($query->result_array() as $key => $value) {
                $return[$key]['application'] = $this->Mapplication->getCountApplicationByCourseId($value['id']);                  
                //$return[$key]['course'] = $this->getAdminCourseByID($value['course_id']);            
                if(!empty($return[$key]['application'])){
                    $return[$key]['sum_applicants'] = $this->sum_applicants($return[$key]['application'],'sum_applicants');
                }else{
                    $return[$key]['sum_applicants'] = 0;
                }
                     
            }
            return $return;
        } else {
            return false;
        }
    }
    public function getAdminCourseAll()
    { // รวมโครงการทั้งหมด จาก location
        $this->db->order_by('id','DESC');
        $query = $this->db->get('course_location'); 
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            foreach ($query->result_array() as $key => $value) {
                $return[$key]['application'] = $this->Mapplication->getCountApplicationByCourseId($value['id']);                  
                $return[$key]['course'] = $this->getAdminCourseByID($value['course_id']);            
                if(!empty($return[$key]['application'])){
                    $return[$key]['sum_applicants'] = $this->sum_applicants($return[$key]['application'],'sum_applicants');
                }else{
                    $return[$key]['sum_applicants'] = 0;
                }
                     
            }
            return $return;
        } else {
            return false;
        }
    }
    private function sum_applicants($myArray,$sub)
    {
        $sum = 0;        
        foreach ($myArray as $k=>$subArray) {
            $sum+=$subArray['sum_applicants'];
        }
        return $sum;
    }
    function get_course_by_id($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('course');
        return $query->row_array();            
    }
}
