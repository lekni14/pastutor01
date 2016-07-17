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

class District extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        // load model
        $this->load->model(array('Msubdistrict'));
    }
    function tumbon_get() {
        $tumbon = $this->Msubdistrict->getSubDistrict($this->get('id'));
        if ($tumbon) {
            $this->response($tumbon, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any tumbon!'), 404);
        }
    }
}
