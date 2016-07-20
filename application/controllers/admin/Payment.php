<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Payment
 *
 * @author dd
 */
class Payment extends CI_Controller {
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        // load model
        $this->load->library('cart');
        $this->load->library(array('breadcrumbs','Formatdate'));
        $this->load->model(array('Mpayments','MCourse','Mapplication','Madministrator'));
    }
    public function index()
    {
        if($this->session->has_userdata('admin')){
            //$flow_id = 3;//ชำระเงินแล้ว
            //$data['application']=$this->Mpayments->getPaymentAll();
            $this->load->view('admin/payment/payment');
        }else{
            redirect('administrator/login');
        }        
    }
    public function NOPayment()
    {
        if($this->session->has_userdata('admin')){
            //$flow_id = 1;//ยังไม่ชำระเงิน
            $data['marketing']=$this->Madministrator->get_marketing_acive();
            $this->load->view('admin/payment/no-pay',$data);
        }else{
            redirect('administrator/login');
        }        
    }
    public function detail($id)
    {        
        if($this->session->has_userdata('admin')){
            $data['application'] = $this->Mapplication->getApplicatoinByID($id);
            $this->load->view('admin/payment/payment-detail',$data);            
        }else{
            redirect('administrator/login');
        }  
    }
    public function ajax_unpaid_list() {
        $count = $this->Mpayments->count_all();
        $lists = $this->Mpayments->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($lists as $key=> $list) {            
            $member = $this->Mmember->get_by_id($list->member_id);            
            $application = $this->Mapplication->get_aplicatoin_by_id($list->application_id);
            $course = $this->MCourse->getAdminCourseByID($application['course_id']);
            $flow_name = $this->Mapplication_flow->getApplication_flow_by_app($application['application_flow_id']);
            $market = $this->Madministrator->getById($application['admin_id']);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $application['app_code'];  
            $row[] = $member['identification'];  
            $row[] = $member['first_name'] . '  ' . $member['last_name'];
            $row[] = $course['name'];
            $row[] = $this->formatdate->generate_date_today("d M Y H:i", strtotime($application['applicant_date']), "th", true);
            $row[] = $flow_name['name'];            
            $row[] = ($market)?$market['first_name'] . '  ' . $market['last_name']:'ผลงานระบบ';

            //add html for action
            $row[] = '<a onclick="pay('.$list->payments_id.','.$list->application_id.')" href="javascript:void(0)"  class="btn btn-primary btn-pay"><i class="icon-pencil icon-white"></i></a>';            
            //href="'.base_url('api/payment/update').'"
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($lists),
            "recordsFiltered" => $count,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
