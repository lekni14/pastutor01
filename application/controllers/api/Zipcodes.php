<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Zipcodes
 *
 * @author NiponRoom
 */
require APPPATH . '/libraries/REST_Controller.php';
class Zipcodes extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        // load model
        $this->load->model(array('Mzipcodes'));
    }
    function zipcodes_get() {
        $zipcodes = $this->Mzipcodes->getZipcodes($this->get('id'));        
        if ($zipcodes) {
            $this->response($zipcodes, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any zipcodes!'), 404);
        }
    }
}