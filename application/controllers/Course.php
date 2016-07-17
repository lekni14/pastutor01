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

    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        // load model
        $this->load->library('cart');
        $this->load->model(array('Mcourse','Mcourse_location','Mapplication'));
    }
    public function index()
    {       
        $data['course'] = $this->Mcourse->getCourse();
        if($this->session->has_userdata('login')){  
            $session = $this->session->userdata('login');
            $data['application'] = $this->Mapplication->check_application($session['id']);
        }
//        print_r($data['application']);
//        exit();
        $this->load->view('course/index',$data);
    }
    public function course_detail($id)
    {
        $data['course'] = $this->Mcourse->getCourseByID($id);
        $this->load->view('course/course-detail',$data);
    }
    public function location($id)
    {
        $array = $this->Mcourse_location->getLocationByFID($id);
        $localtion = array();
        foreach ($array as $key => $value) {
            $localtion[] = array(
                'id'=>$value['id'],
                'name'=>$value['name'],
                'course_date'=>$value['course_date']
            );
        }
        echo json_encode($array);
    }
    public function cart()
    {
        
    }

}
