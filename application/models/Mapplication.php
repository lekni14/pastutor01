<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mapplication
 *
 * @author dd
 */
class Mapplication extends CI_Model {

    var $table = 'applicantion';
    var $column_order = array('app_code','member.first_name','member.contact_no',null,null,'applicant_date',null); //set column field database for datatable orderable
    var $column_search = array('app_code','member.first_name','member.last_name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('applicantion.id' => 'desc'); // default order 
    function __construct() {
        // Construct the parent class
        parent::__construct();
        // load model
        $this->load->model(array('Mcourse', 'Mapplicants', 'Mapplication_flow','Mpayments','Mmember'));
    }
    public function count_all_by_course()
    {        
        $fiter = array();
        $sesion = $this->session->userdata('admin');
        if($sesion['permission_id']==2){
            $this->db->where('admin_id',$sesion['id']);
        }
        if($_GET['name']=='nopay'){
            $where = 'where_in';
            $fiter = array('1','8','9');
        }elseif($_GET['name']=='holders'){
            $where = 'where_in';
            $fiter = array('3','7');
        }else{
            $where = 'where_not_in';
            $fiter = array('0');
        }
        $this->db->from($this->table);
        $this->db->$where('application_flow_id',$fiter);
        $this->db->where('applicantion.course_id', $_POST['course_id']);
        return $this->db->count_all_results();
    }
    private function _get_datatables_query()
    {         
        $this->db->select('*,member.id as member_id,applicantion.id as application_id,course_location.id as course_location_id');
        $this->db->join('member','member.id=applicantion.member_id');
        $this->db->join('course_location','course_location.id=applicantion.course_location_id');
        $this->db->from($this->table); 
        $i = 0;     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $fiter = array();
//        array('3','7');//เข้าร่วม
//        array('1','8','9');//ไม่ชำระเงิน
        if($_GET['name']=='nopay'){
            $where = 'where_in';
            $fiter = array('1','8','9');
        }elseif($_GET['name']=='holders'){
            $where = 'where_in';
            $fiter = array('3','7');
        }else{
            $where = 'where_not_in';
            $fiter = array('0');
        }
        $this->_get_datatables_query();
        $sesion = $this->session->userdata('admin');
        if($sesion['permission_id']==2){
            $this->db->where('admin_id',$sesion['id']);
        }
        if($_POST['length'] != -2)
            
        $this->db->$where('application_flow_id',$fiter);
        $this->db->where('applicantion.course_id', $_POST['course_id']);
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    public function insert_entry($data) {
        $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update_entry($data) {
        $this->db->where('id', $data['id']);
        $this->db->update($this->table, $data);
    }
    public function hasapp($course_id,$member_id)
    {
        $this->db->where_in('applicantion.application_flow_id', array('1','3','7'));
        $this->db->where('course_id', $course_id);
        $this->db->where('member_id', $member_id);
        $this->db->from('applicantion');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        }else{
            return false;
        }
    }
    public function check_application($data) {
        $this->db->select('*');
        $this->db->select('applicantion.id as id');
        $this->db->select('course_location.id as course_location_id');        
        $this->db->join('course_location', 'applicantion.course_location_id = course_location.id');
        $this->db->where('course_location.course_date >=', date('Y-m-d'));
        $this->db->where('member_id', $data);
        $this->db->where_in('applicantion.application_flow_id', array('1','3','7'));
        $this->db->from('applicantion');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            foreach ($query->result_array() as $key => $value) {
                $return[$key]['course'] = $this->Mcourse->getCourseByID($value['course_id']);
                $return[$key]['location'] = $this->Mcourse_location->getLocationByID($value['course_location_id']);
                $return[$key]['payments'] = $this->Mpayments->getPaymentByApp($value['id']); 
                $return[$key]['applicants'] = $this->Mapplicants->getApplicantsByApp($value['id']);
                $return[$key]['flow'] = $this->Mapplication_flow->getApplication_flow_by_app($value['application_flow_id']);
            }
            return $return;
        } else {
            return false;
        }
    }

    public function getApplicatoinByID($data) {
        $this->db->where('id', $data);
        $query = $this->db->get('applicantion');
        if ($query->num_rows() > 0) {
            $return = $query->row_array();
            $return['member'] = $this->Mmember->getMember($return['member_id']);
            $return['course'] = $this->Mcourse->getCourseByID($return['course_id']);
            $return['location'] = $this->Mcourse_location->getLocationByID($return['course_id']);
            $return['payments'] = $this->Mpayments->getPaymentByApp($return['id']); 
            $return['applicants'] = $this->Mapplicants->getApplicantsByApp($return['id']);
            $return['flow'] = $this->Mapplication_flow->getApplication_flow_by_app($return['application_flow_id']);
            return $return;
        } else {
            return FALSE;
        }
    }
    public function getApplicationAll($flow_id)
    {
        $this->db->select('*');
        $this->db->select('applicantion.id as id');
        $this->db->select('course_location.id as course_location_id');        
        $this->db->join('course_location', 'applicantion.course_location_id = course_location.id');
        $this->db->where('course_location.course_date >=', date('Y-m-d'));
        $this->db->where('application_flow_id', $flow_id);
        $this->db->from('applicantion');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            foreach ($query->result_array() as $key => $value) {
                $return[$key]['member'] = $this->Mmember->getMember($value['member_id']);
                $return[$key]['course'] = $this->Mcourse->getCourseByID($value['course_id']);
                $return[$key]['location'] = $this->Mcourse_location->getLocationByID($value['course_id']);
                $return[$key]['payments'] = $this->Mpayments->getPaymentByApp($value['id']); 
                $return[$key]['applicants'] = $this->Mapplicants->getApplicantsByApp($value['id']);
                $return[$key]['flow'] = $this->Mapplication_flow->getApplication_flow_by_app($value['application_flow_id']);
            }
            return $return;
        } else {
            return false;
        }
    }
    public function getApplicationFlowAdmin($course_id,$flow_id)
    {
        $this->db->select('*');
        $this->db->select('applicantion.id as id');
        $this->db->select('course_location.id as course_location_id');        
        $this->db->join('course_location', 'applicantion.course_location_id = course_location.id');
        $this->db->where('course_location.course_date >=', date('Y-m-d'));
        $this->db->where('applicantion.course_id', $course_id);
        $this->db->where_in('application_flow_id', $flow_id);
        $this->db->from('applicantion');
        $query = $this->db->get();
        $sum =0;
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            foreach ($query->result_array() as $key => $value) {
                $return[$key]['member'] = $this->Mmember->getMember($value['member_id']);
                $return[$key]['course'] = $this->Mcourse->getCourseByID($value['course_id']);
                $return[$key]['location'] = $this->Mcourse_location->getLocationByID($value['course_id']);
                $return[$key]['payments'] = $this->Mpayments->getPaymentByApp($value['id']); 
                $return[$key]['applicants'] = $this->Mapplicants->getApplicantsByApp($value['id']);
                $return[$key]['sum_applicants'] = $this->Mapplicants->getCountapplicantsByApp($value['id']);
                $return[$key]['flow'] = $this->Mapplication_flow->getApplication_flow_by_app($value['application_flow_id']);
            }
            return $return;
        } else {
            return false;
        }
    }
    public function getApplicationHoldersAllAdmin()
    {
        $flow_id = 3;
        $this->db->select('*');
        $this->db->select('applicantion.id as id');
        $this->db->select('course_location.id as course_location_id');        
        $this->db->join('course_location', 'applicantion.course_location_id = course_location.id');
        $this->db->where('course_location.course_date >=', date('Y-m-d'));
        $this->db->where('applicantion.course_id', $course_id);
        $this->db->where('application_flow_id', $flow_id);
        $this->db->from('applicantion');
        $query = $this->db->get();
        $sum =0;
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            foreach ($query->result_array() as $key => $value) {
                $return[$key]['member'] = $this->Mmember->getMember($value['member_id']);
                $return[$key]['course'] = $this->Mcourse->getCourseByID($value['course_id']);
                $return[$key]['location'] = $this->Mcourse_location->getLocationByID($value['course_id']);
                $return[$key]['payments'] = $this->Mpayments->getPaymentByApp($value['id']); 
                $return[$key]['applicants'] = $this->Mapplicants->getApplicantsByApp($value['id']);
                $return[$key]['sum_applicants'] = $this->Mapplicants->getCountapplicantsByApp($value['id']);
                $return[$key]['flow'] = $this->Mapplication_flow->getApplication_flow_by_app($value['application_flow_id']);
            }
            return $return;
        } else {
            return false;
        }
    }
    public function getCountApplicationByCourseId($course_id)
    {
        $this->db->select('*');       
        $this->db->where('applicantion.course_id', $course_id);
        $this->db->from('applicantion');
        $query = $this->db->get();
        $sum =0;
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            foreach ($query->result_array() as $key => $value) {
                $return[$key]['sum_applicants'] = $this->Mapplicants->getCountapplicantsByApp($value['id']);
            }
            return $return;
        } else {
            return false;
        }
    }   
    public function getDatatablesByCourseId($course_id,$length,$start)
    {
        $this->db->select('*');     
        if($length != -1)
        $this->db->limit($length, $start);
        $this->db->where('applicantion.course_id', $course_id);
        $this->db->from('applicantion');
        $query = $this->db->get();
        $sum =0;
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            foreach ($query->result_array() as $key => $value) {
                $return[$key]['member'] = $this->Mmember->getMember($value['member_id']);
                $return[$key]['course'] = $this->Mcourse->getCourseByID($value['course_id']);
                //$return[$key]['location'] = $this->Mcourse_location->getLocationByID($value['course_id']);
                //$return[$key]['payments'] = $this->Mpayments->getPaymentByApp($value['id']); 
                //$return[$key]['applicants'] = $this->Mapplicants->getApplicantsByApp($value['id']);
                $return[$key]['sum_applicants'] = $this->Mapplicants->getCountapplicantsByApp($value['id']);
                $return[$key]['flow'] = $this->Mapplication_flow->getApplication_flow_by_app($value['application_flow_id']);
            }
            return $return;
        } else {
            return false;
        }
    } 
    public function getApplicationByCourseId($course_id)
    {
        $this->db->select('*');        
        $this->db->where('applicantion.course_id', $course_id);
        $this->db->from('applicantion');
        $query = $this->db->get();
        $sum =0;
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            foreach ($query->result_array() as $key => $value) {
                $return[$key]['member'] = $this->Mmember->getMember($value['member_id']);
                $return[$key]['course'] = $this->Mcourse->getCourseByID($value['course_id']);
                //$return[$key]['location'] = $this->Mcourse_location->getLocationByID($value['course_id']);
                //$return[$key]['payments'] = $this->Mpayments->getPaymentByApp($value['id']); 
                //$return[$key]['applicants'] = $this->Mapplicants->getApplicantsByApp($value['id']);
                $return[$key]['sum_applicants'] = $this->Mapplicants->getCountapplicantsByApp($value['id']);
                $return[$key]['flow'] = $this->Mapplication_flow->getApplication_flow_by_app($value['application_flow_id']);
            }
            return $return;
        } else {
            return false;
        }
    }   

    public function getLastId($course_id)
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('course_id',$course_id);
        $query = $this->db->get('applicantion');
        return $query->row_array();
    }
    public function getAppByCode($code)
    {
        $this->db->where('app_code',$code);
        $query = $this->db->get('applicantion');
        if ($query->num_rows() > 0) {
            return $query->row()->member_id;
        }else{
            return FALSE;
        }
    }

}
