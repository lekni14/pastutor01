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
        $this->load->model(array('Mpayments'));
    }
    public function index()
    {
        if($this->session->has_userdata('admin')){
            $flow_id = 3;//ชำระเงินแล้ว
            $data['application']=$this->Mpayments->getPaymentAll();
            $this->load->view('admin/payment/payment',$data);
        }else{
            redirect('administrator/login');
        }        
    }
    public function NOPayment()
    {
        if($this->session->has_userdata('admin')){
            $flow_id = 1;//ยังไม่ชำระเงิน
            $data['application']=$this->Mpayments->getNoPaymentAll();
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
}
