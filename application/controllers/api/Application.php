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

class Application extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        // load model
        $this->load->model(array('Mapplication', 'Mapplicants', 'Mpayments','Mmarketing'));
    }
    private function generate_code($course_id)
    {
        $yearMonth = substr(date("Y") + 543, -2);
        $course_id = substr("000" . $course_id, -3);
        $retrun = $this->Mapplication->getLastId($course_id);
        $str = substr($retrun['app_code'], 5);
        $str = ltrim($str, '0');
        $maxId = $retrun['id']; 
        $maxId = ($maxId + 1);

        $maxId = substr("00000" . $maxId, -5);
        $nextId = $yearMonth.$course_id. $maxId;
        return $nextId;
    }
    function application_post() {
        $this->load->library('cart');
        if ($this->post('id')) {
        } else {
            $member = $this->session->userdata('login');
            $admin = $this->Mmarketing->get__by_identification($member['identification'],$this->post('course_id'));
            $app = array(
                'app_code' => $this->generate_code($this->post('course_id')),
                'course_location_id' => $this->post('course_location_id'),
                'course_id' => $this->post('course_id'),
                'member_id' => $this->post('member_id'),
                'application_flow_id' => 1,
                'applicant_date' => date('Y-m-d H:i:s'),
                'admin_id' => ($admin)?$admin->admin_id:0,
            );
            $app['application_id'] = $this->Mapplication->insert_entry($app);
            foreach ($this->post('applicants') as $key => $value) {
                $value['application_id'] = $app['application_id'];
                $this->Mapplicants->insert_entry($value);
            }
            $pay = array(
                'member_id' => $this->post('member_id'),
                'application_id' => $app['application_id'],
                'balance' => $this->post('balance'),
                'discount' => $this->post('discount'),
                'due_date' => date('Y-m-d', strtotime("+7 days")),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->Mpayments->insert_entry($pay);
            $this->cart->destroy();
        }
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
    function application_cancel_post(){
        $pay = array(
                'id' => $this->post('id'),
                'application_flow_id' => 6,
            );
        $this->Mapplication->update_entry($pay);
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
    function application_by_coures_get()
    {
        $retrun = $this->Mapplication->getApplicationByCourseId($this->get('id'));
//        $data = array();
//        foreach ($array as $key => $value) {
//            $data[] = array(
//                ''=>,
//                ''=>,
//                ''=>,
//                ''=>,
//                ''=>,
//                ''=>,
//                ''=>,
//                ''=>,
//            );
//        }
        $response = array( 'sEcho' => 5,
                   'iTotalRecords' => 5,
                   'iTotalDisplayRecords' => 5,
                   'aaData' => array(array('id' => 1, 'name' => 'stackoverflow'),
                                     array('id' => 2, 'name' => 'google')),
                 ); 
        if($retrun){
            $this->response(array('data'=>$retrun), 200); 
        }else{
            $message = array('result' => FALSE);
        }
        $this->response($message, 200); // 200 being the HTTP response code
    }

}
