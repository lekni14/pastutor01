<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
 */
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Payments extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        // load model
        $this->load->model(array('Mapplication', 'Mapplicants', 'Mpayments'));
    }
    function payments_update_post() {
         $app = array(
            'id' => $this->post('application_id'),
            'application_flow_id' => $this->post('application_flow_id'),
        );
        $pay = array(
                'id' => $this->post('id'),
                'is_payment' => 1,
                'updated_at'=>date('Y-m-d H:i:s'),
           );
        $this->Mapplication->update_entry($app);
        $this->Mpayments->update_entry($pay);
        $message = array('result' => TRUE, 'data' => $app);
        $this->response($message, 200); // 200 being the HTTP response code
    }

    function application_update_post() {
            $pay = array(
                'id' => $this->post('payment_id'),
                'balance' => $this->post('balance'),
                'discount' => $this->post('discount'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->Mpayments->update_entry($pay);
        foreach ($this->post('applicants') as $key => $value) {
            if(isset($value['id'])){
                continue;
            }else{                
                $this->Mapplicants->insert_entry($value);
            }
        }
        $message = array('result' => TRUE);
        $this->response($message, 200); // 200 being the HTTP response code
    }
    function applicant_delete_post() {
        $retrun = $this->Mapplicants->DeleteApplicantsById($this->post('id'));
        if($retrun){
            $message = array('result' => TRUE, 'data' => $this->post('row'));
        }else{
            $message = array('result' => FALSE);
        }
        $this->response($message, 200); // 200 being the HTTP response code
    }

}
