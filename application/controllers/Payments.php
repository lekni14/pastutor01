<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Payin
 *
 * @author dd
 */
class Payments extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("Pdf");
        $this->load->model('Mapplication');
        $this->load->model('Mmember');
    }

    public function index() {
        //I'm just using rand() function for data example
        $temp = '590010000130062016';
        $this->set_barcode($temp);
    }

    private function set_barcode($code) {
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode
        Zend_Barcode::render('code128', 'image', array('text' => $code), array());
    }

    public function application_print($id) {
        $data['title'] = 'ใบแจ้งค่าชำระเรียน';
        $data['application'] = $this->Mapplication->getApplicatoinByID($id);
        $this->load->view('payments/payin', $data);
    }

}
