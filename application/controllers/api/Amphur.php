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

class Amphur extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        // load model
        $this->load->model(array('Mdistrict'));
    }
    function amphur_get() {
        $amphur = $this->Mdistrict->getDistrict($this->get('id'));
        if ($amphur) {
            $this->response($amphur, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any amphur!'), 404);
        }
    }
}
