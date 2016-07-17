<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Member
 *
 * @author dd
 */
class Member extends CI_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        // load model        
        $this->load->model(array('Mmember','Mapplication','Mmember_level'));
        $this->load->library(array('breadcrumbs', 'Formatdate'));
    }

    public function member_index() {
        if ($this->session->has_userdata('admin')) {
            $data['member'] = $this->Mmember->getMemberAll();
            $this->breadcrumbs->index_member();
            $this->load->view('admin/member/member_index', $data);
        } else {
            redirect('administrator/login');
        }
    }

    public function member_detail($id) {
        if ($this->session->has_userdata('admin')) {
            $data['member'] = $this->Mmember->getMember($id);
            $this->breadcrumbs->detail_member();
            $this->load->view('admin/member/member_detail', $data);
        } else {
            redirect('administrator/login');
        }
    }

    public function uplevel() {
        $this->load->library('excel');
        
        $file = explode(".", $_FILES['file']['name']);
        if((end($file)!='xlsx')&&(end($file)!='xls')){
            $msg = array('result'=>FALSE,'msg'=>'สามารถอัพโหลดได้เฉพาะ (.xlsx) และ (.xls)');
        }else{
            $inputFileName = $_FILES['file']['tmp_name'];
    //        print_r(end($msg));
    //        exit();
            //  Read your Excel workbook
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            }

    //  Get worksheet dimensions
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

    //  Loop through each row of the worksheet in turn
            $no =0;
            for ($row = 1; $row <= $highestRow; $row++) {
                //  Read a row of data into an array
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                $code = explode(" ", $rowData[0][1]);
                $id = $this->Mapplication->getAppByCode(end($code));
                if($id){
                    $member = $this->Mmember->get_by_id($id);
                    if($member['levelID']<3){
                        ++$no;
                        $this->Mmember->update_entry(array('id'=>$id,'levelID'=>$member['levelID']++));
                    }
                }
                
            }
            $msg = array('result'=>TRUE,'msg'=>'อัตเดตสมาชิกเรียนร้อย อัตเเดตทั้งหมด '.$no);
        }
        echo json_encode($msg);        
    }
    public function ajax_list() {
        $session = $this->session->userdata('admin');
        $count = $this->Mmember->count_all_by_course($this->uri->segment(3));
        $list = $this->Mmember->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $school = $this->Mschool->getSchoolByID($person->school_id);
            $level = $this->Mmember_level->get_by_id($person->levelID);
            $no++;
            $row = array();
            $row[] = $person->member_code;
            $row[] = $person->identification;
            $row[] = $person->first_name . '  ' . $person->last_name;
            $row[] = $person->nickname;
            $row[] = $school['school_name'];            
            $row[] = $school['province']['PROVINCE_NAME'];
            $row[] = $level['name'];
            $row[] = $this->formatdate->generate_date_today("d M Y", strtotime($person->create_at), "th", true);

            //add html for action
            $row[] = anchor('administrator/member/' . $person->id, '<i class="icon-list icon-white"></i>', 'class="btn btn-success"');;

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
}
