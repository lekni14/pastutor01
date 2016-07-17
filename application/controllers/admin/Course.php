<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Course
 *
 * @author dd
 */
class Course extends CI_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        // load model
        $this->load->library('breadcrumbs');
        $this->load->model(array('Mcourse','Mstorage'));
    }

    public function index() {
        if ($this->session->has_userdata('admin')) {

            $this->breadcrumbs->list_course();
            $data['course'] = $this->Mcourse->getAdminCourseAll();
            $this->load->view('admin/course/course_index', $data);
        } else {
            redirect('administrator/login');
        }
    }

    public function create() {
        if ($this->session->has_userdata('admin')) {

            $this->breadcrumbs->create_course();
            $this->load->view('admin/course/course_create');
        } else {
            redirect('administrator/login');
        }
    }

    public function detail($id) {
        if ($this->session->has_userdata('admin')) {

            $this->breadcrumbs->detail_course();
            $data['course'] = $this->Mcourse->getAdminCourseByID($id);
            $this->load->view('admin/course/course_detail', $data);
        } else {
            redirect('administrator/login');
        }
    }

    public function edit($id) {
        if ($this->session->has_userdata('admin')) {

            $this->breadcrumbs->edit_course();
            $data['course'] = $this->Mcourse->getAdminCourseByID($id);
            $this->load->view('admin/course/course_edit', $data);
        } else {
            redirect('administrator/login');
        }
    }  

    public function download($id) {
        $file = $this->Mstorage->getFileByID($id);
        $path = $file['upload_path'].$file['new_image'];
        if($file){
            header('Content-Description: File Transfer');
            header('Content-Type:'.$file['file_type']);
            header('Content-Disposition: attachment; filename="'.basename($path).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($path));
            readfile($path);
            exit();
        }else{
            echo $msg = 'ไม่พบไฟล์';
            //echo json_encode($msg);
        }
    }

}
