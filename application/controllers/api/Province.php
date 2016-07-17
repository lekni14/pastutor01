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

class Province extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        // load model
        $this->load->model(array('Mprovince'));
    }
    function province_get() {
        $province = $this->Mprovince->getProvince();
        if ($province) {
            $this->response($province, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any provinces!'), 404);
        }
    }
    function province_bygeo_get() {
        $province = $this->Mprovince->getProvinceByGeo();
        if ($province) {
            $this->response($province, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any provinces!'), 404);
        }
    }
}
