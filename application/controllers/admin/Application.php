<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Application
 *
 * @author dd
 */
class Application extends CI_Controller{
    
    function __construct() {
        // Construct the parent class
        parent::__construct();
        // load model        
        $this->load->library(array('breadcrumbs','Formatdate'));
        $this->load->model(array('Mcourse','Mapplicants','Mpayment_follow'));
    }
    private function permission(){
        $permission = $this->session->userdata('admin');
        return $permission['permission_id'];
    }        
    public function application_index()
    {
        if ($this->session->has_userdata('admin')) {

            $this->breadcrumbs->list_application();
            $data['course'] = $this->Mcourse->getAdminCourseAll();
            $this->load->view('admin/application/application_index', $data);
        } else {
            redirect('administrator/login');
        }
    }
    public function application_list($id)
    {   $data['course_id'] = $id;
        if ($this->session->has_userdata('admin')) {
            $this->breadcrumbs->list_application_detail($id);
//                $data['application'] = $this->Mapplication->getApplicationByCourseId($id);
//            $data['pay'] = $this->Mapplication->getApplicationFlowAdmin($id,array(1,8,9,10));
//           $data['holders'] = $this->Mapplication->getApplicationFlowAdmin($id,array(3,7));
            if($this->permission()==1){
                $this->load->view('admin/application/application_list', $data);
            }else{
                $this->load->view('admin/application/martketing_application_list', $data);
            }            
        } else {
            redirect('administrator/login');
        }
    }
    public function application_list_detail($course_id,$application_id)
    {
        if ($this->session->has_userdata('admin')) {

            $this->breadcrumbs->list_application_detail_list($course_id);
            $data['application'] = $this->Mapplication->getApplicatoinByID($application_id);
            $data['follow'] = $this->Mpayment_follow->getFollowByCourse($application_id);
            $this->load->view('admin/application/application_list_detail', $data);
        } else {
            redirect('administrator/login');
        }
    }
    public function payment_follow()
    {
        $data = array(
            'admin_id'=>$this->input->post('admin_id'),
            'application_id'=>$this->input->post('application_id'),
            'report'=>$this->input->post('report'),
            'created_at'=>  Date('Y-m-d H:i:s'),
            'updated_at'=>  Date('Y-m-d H:i:s'),
        );
        $pay = array(
                'id' => $this->input->post('application_id'),
                'application_flow_id' => $this->input->post('application_flow_id'),
            );
        $this->Mapplication->update_entry($pay);
        $this->Mpayment_follow->entry_insert($data);
        echo json_encode(array('result'=>true,'data'=>$data));
    }
    public function payment_follow_cancle()
    {
        $pay = array(
                'id' => $this->input->post('application_id'),
                'application_flow_id' => $this->input->post('application_flow_id'),
            );
        $this->Mapplication->update_entry($pay);
        echo json_encode(array('result'=>true));
    }
    public function application_print($id) {
        //$this->load->library("Pdf");
        $data['title'] = 'ใบแจ้งค่าชำระเรียน';
        $data['application'] = $this->Mapplication->getApplicatoinByID($id);
        $this->load->view('payments/payin', $data);
    }
    public function print_allpication($id)
    {
        //load library
        $this->load->library('zend');
        //generate barcode
        $this->load->library("Pdf");
        $data['title'] = 'ใบลงทะเบียนหน้างาน';
        $data['application'] = $this->Mapplication->getApplicatoinByID($id);
        $this->load->view('application/pdf_application', $data);
    }
    public function ajax_list() {
        $_POST['course_id'] = $this->uri->segment(3);
        $count = $this->Mapplication->count_all_by_course($this->uri->segment(3));
        if(!empty($_GET['export'])){
            $_POST['length'] = $count;
        }
        $list = $this->Mapplication->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key=> $application) {
            $flow_name = $this->Mapplication_flow->getApplication_flow_by_app($application->application_flow_id);
            $no++;
            $row = array();
            //$row[] = ++$key;
            $row[] = $application->app_code;            
            $row[] = $application->first_name . ' ' . $application->last_name;
            $row[] = $application->nickname;
            $row[] = $application->contact_no;
            $row[] = $this->Mapplicants->count_all_by_course($application->application_id);
            $row[] = $flow_name['name'];            
            $row[] = $this->formatdate->generate_date_today("d M Y H:i", strtotime($application->applicant_date), "th", true);
            $row[] = $this->formatdate->countday($application->applicant_date).' วันที่แล้ว';

            //add html for action
            $row[] = anchor('administrator/application/detail/' . $application->course_id . '/' . $application->application_id, '<i class="icon-list icon-white"></i>', 'class="btn btn-success"');

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
    function export_excel()
    {
        $_POST['course_id'] = $this->uri->segment(4);
        $count = $this->Mapplication->count_all_by_course($_POST['course_id']);
        $_POST['search']['value'] = '';
        $_POST['start']=0;
        $_POST['length']=$count;        
        $this->load->library('excel');
        $heading=array('No','รหัสใบสมัคร','ชื่อนามสกุล','ชื่อเล่น','เบอร์โทร','จำนวนผู้สมัคร','วันที่สมัคร','สถานนะ');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('test');
        $rowNumberH = 1;
        $colH = 'A';
        foreach($heading as $h){
            $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
            $colH++;    
        }
        $list = $this->Mapplication->get_datatables();
                $row = 2;
        $no = 1;
        foreach($list as $application){
            $flow_name = $this->Mapplication_flow->getApplication_flow_by_app($application->application_flow_id);
            //$numnil = (float) str_replace(',','.',$n->nilai);
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$no);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$application->app_code);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$application->first_name . ' ' . $application->last_name);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$application->nickname);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$application->contact_no,PHPExcel_Cell_DataType::TYPE_NUMERIC);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('F'.$row,$this->Mapplicants->count_all_by_course($application->application_id),PHPExcel_Cell_DataType::TYPE_NUMERIC);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$this->formatdate->generate_date_today("d M Y H:i", strtotime($application->applicant_date), "th", true));
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$flow_name['name']);
            $row++;
            $no++;
        }
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="application.xls"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');
        exit();
    }
}
