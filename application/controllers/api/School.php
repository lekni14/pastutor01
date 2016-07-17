<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of School
 *
 * @author NiponRoom
 */

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
class School extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        // load model
        $this->load->model(array('Mschool'));
    }
    function school_by_province_get() {
        $school = $this->Mschool->getSchoolByProvince($this->get('id'));
        if ($school) {
            $this->response($school, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any school!'), 404);
        }
    }
}
