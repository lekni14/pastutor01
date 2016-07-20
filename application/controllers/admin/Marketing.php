<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Marketing
 *
 * @author dd
 */
class Marketing extends CI_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        // load model        
        $this->load->library(array('breadcrumbs', 'Formatdate'));
        $this->load->model(array('Mcourse', 'Mmarketing','Madministrator','Mapplication'));        
    }    
    public function marketing_index() {
        if($this->session->has_userdata('admin')) {
            $this->breadcrumbs->marketing_index();
            $data['course'] = $this->Mcourse->getAdminCourseAll();
            $this->load->view('admin/marketing/marketing_index', $data);
        } else {
            redirect('administrator/login');
        }
    }
    public function marketing_list($id) {
        //$data['course_id'] = $id;
        if ($this->session->has_userdata('admin')) {
            $sesion = $this->session->userdata('admin');
            $this->breadcrumbs->list_marketing_detail($id);
            $data['course'] = $this->Mcourse_location->getLocationByID($id);
            if($sesion['permission_id']==1){
                $this->load->view('admin/marketing/application_list', $data);
            }else{
                $this->load->view('admin/marketing/marketing_list', $data);
            }            
        } else {
            redirect('administrator/login');
        }
    }
    public function marketing_paymet($id)
    {
        $data['course_location_id'] = $id;
        $session = $this->session->userdata('admin');
        if ($this->session->has_userdata('admin')) {
             $this->load->view('admin/marketing/marketing_paymet',$data);
         } else {
             redirect('administrator/login');
         } 
    }
    public function ajax_list() {
        $session = $this->session->userdata('admin');
        $_POST['admin_id'] = $session['id'];
        $_POST['course_location_id'] = $this->uri->segment(3);
        $count = $this->Mmarketing->count_all_by_course($this->uri->segment(3));
        $list = $this->Mmarketing->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = $person->identification;
            $row[] = $person->first_name . ' ' . $person->last_name;
            $row[] = $person->nickname;
            $row[] = $person->contact_no;
            $row[] = $this->formatdate->DatetimeThai("d M Y", strtotime($person->created_at), "th", true);

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit(' . "'" . $person->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $person->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($list),
            "recordsFiltered" => $count,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id) {
        $data = $this->Mmarketing->get_by_id($id);
        echo json_encode($data);
    }
    function dataPost() {
        $session = $this->session->userdata('admin');
        $data = array(
            'admin_id'=> $session['id'],
            'course_id' => $this->input->post('course_id'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'nickname' => $this->input->post('nickname'),
            'contact_no' => $this->input->post('contact_no'),
            'identification' => $this->input->post('identification'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        
        if (empty($_POST['id'])) {
            if ($this->Mmarketing->entry_insert($data)) {
                $msg = array('result' => TRUE);
            } else {
                $msg = array('result' => FALSE);
            }
        } else { 
            if ($this->Mmarketing->entry_update($this->input->post('id'),$data)) {
                $msg = array('result' => TRUE);
            } else {
                $msg = array('result' => FALSE);
            }
        }
        echo json_encode($msg);
    }
    function delete()
    {
        if ($this->Mmarketing->delete_by_id($this->input->post('id'))) {
            $msg = array('result' => TRUE);
        } else {
            $msg = array('result' => FALSE);
        }  
        echo json_encode($msg);
    }
    public function ajax_payment_list() {
        // การตลาด ใบสมัคร
       
        $session = $this->session->userdata('admin');
        $_POST['admin_id'] = $session['id'];
        $_POST['course_location_id'] = $this->uri->segment(3);
        $count = $this->Mapplication->count_all_by_course($this->uri->segment(3));
        $list = $this->Mapplication->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $flow_name = $this->Mapplication_flow->getApplication_flow_by_app($person->application_flow_id);
            $market = $this->Madministrator->getById($person->admin_id);
            $row[] = $person->identification;
            $row[] = $person->first_name . ' ' . $person->last_name;
            $row[] = $person->contact_no;
            $row[] = $flow_name['name']; ;
            $row[] = $this->formatdate->DatetimeThai("d M Y", strtotime($person->applicant_date), "th", true);

            //add html for action
            $row[] = $row[] = ($market)?$market['first_name'] . ' ' . $market['last_name']:'ผลงานระบบ';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($list),
            "recordsFiltered" => $count,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function application_ajax_list() {
        $session = $this->session->userdata('admin');
        $_POST['admin_id'] = $session['id'];
        $_POST['course_id'] = $this->uri->segment(3);
        $count = $this->Mmarketing->count_all_by_course($this->uri->segment(3));
        $list = $this->Mmarketing->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = $person->identification;
            $row[] = $person->first_name . ' ' . $person->last_name;
            $row[] = $person->nickname;
            $row[] = $person->contact_no;
            $row[] = $this->formatdate->DatetimeThai("d M Y", strtotime($person->created_at), "th", true);

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit(' . "'" . $person->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $person->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($list),
            "recordsFiltered" => $count,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
        
        
//        $_POST['course_id'] = $this->uri->segment(3);
//        $count = $this->Mapplication->count_all_by_course($this->uri->segment(3));
//        $list = $this->Mapplication->get_datatables();
//        $data = array();
//        $no = $_POST['start'];
//        foreach ($list as $key=> $application) {
//            $flow_name = $this->Mapplication_flow->getApplication_flow_by_app($application->application_flow_id);
//            $market = $this->Madministrator->getById($application->admin_id);
//            $no++;
//            $row = array();
//            //$row[] = ++$key;
//            $row[] = $application->app_code;
//            $row[] = $application->first_name . ' ' . $application->last_name;
//            $row[] = $application->contact_no;
//            $row[] = $flow_name['name'];            
//            $row[] = $this->formatdate->countday($application->applicant_date).' วันที่แล้ว';
//
//            //add html for action
//            $row[] = ($market)?$market['first_name'] . ' ' . $market['last_name']:'ผลงานระบบ';
//
//            $data[] = $row;
//        }
//
//        $output = array(
//            "draw" => $_POST['draw'],
//            "recordsTotal" => count($list),
//            "recordsFiltered" => $count,
//            "data" => $data,
//        );
//        //output to json format
//        echo json_encode($output);
    }

}
