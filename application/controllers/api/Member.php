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

class Member extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        // load model
        $this->load->model(array('Mmember','Maddress'));
    }
    function login_post() {
        $login = array(
            'identification'=>$this->post('identification'),
            'password'=> base64_encode($this->post('password')),
            );
        $return = $this->Mmember->login($login);
        if($return==TRUE){
            $message = array('result'=>TRUE,'message'=>'ยินดีต้อนรับ');
        }  else {
            $message = array('result'=>FALSE,'message'=>'รหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
        }
        $this->response($message, 200); // 200 being the HTTP response code
    }
    private function generate_code()
    {
        $code = "M";
        $yearMonth = substr(date("Y") + 543, -2) . date("m");
        $retrun = $this->Mmember->getLastId();
        $maxId = $retrun['id']; 
        $maxId = ($maxId + 1);

        $maxId = substr("00000" . $maxId, -5);
        $nextId = $code . $yearMonth . $maxId;
        return $nextId;
    }
    function member_post()
    {        
        if($this->Mmember->hasIdentification($this->post('identification'))){
            $message = array('response'=>'false','error'=>'คุณได้เป็นสมาชิกอยู่แล้ว');
        }else{
            $member = array(
                'identification'=>$this->post('identification'),
                'title'=>$this->post('title'),
                'first_name'=>$this->post('firstname'),
                'last_name'=>$this->post('lastname'),
                'nickname'=>$this->post('nickname'),
                'email_address'=>$this->post('email'),
                'contact_no'=>$this->post('contact_no'),
                'school_id'=>$this->post('school_id'),
                'classroom'=>$this->post('classroom'),
                'password'=>  base64_encode($this->post('password')),
                'levelID'=>0,
                'member_code'=>  $this->generate_code(),
                'create_at'=>  date('Y-m-d H:i:s'),
                'update_at'=>  date('Y-m-d H:i:s'),
             );
            $menber_insert = $this->Mmember->insert_entry($member);
            $address = array(
                'province_id'=>$this->post('province_id'),
                'district_id'=>$this->post('district_id'),
                'sub_district_id'=>$this->post('sub_district_id'),
                'postcode'=>$this->post('postcode'),
                'hno'=>$this->post('hno'),
                'mno'=>$this->post('mno'),
                'lane'=>$this->post('lane'),
                'road'=>$this->post('road'),
                'member_id'=>$menber_insert,
            );
            $address_insert = $this->Maddress->insert_entry($address);
            $message = array('response'=>'success','data'=>$member);
        }
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    function member_get() {
        if (!$this->get('id')) {
            $this->response(NULL, 400);
        }

        $member = $this->Mmember->getMember( $this->get('id') );
        if ($member) {
            $this->response($member, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Member could not be found'), 404);
        }
    }

    function member_update_post() {
        if(!empty($_FILES['fileUpload'])){
            $files = $_FILES['fileUpload'];            
            $input = $this->input->post();
            $this->upload_files($files,$input['id']);
        }
        $this->Mmember->update_entry($this->input->post());
        $message = array('result' => TRUE, 'data' => $this->input->post(), 'message' => 'UPDATED!');

        $this->response($message, 200); // 200 being the HTTP response code
    }    
    private function upload_files($files,$member_id)
    {
        
        $config['upload_path']          = 'upload_path/profile/';
        $config['allowed_types']        = 'gif|jpg|png';
        if (!is_dir('upload_path/profile/')) {
            mkdir('./upload_path/profile/', 0777, TRUE);
        }
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('fileUpload'))
        {
            return FALSE;
        }
        else
        {
             $img = array(
                    'tid' => 2,
                    'fid' => $member_id,
                    'upload_path' => 'upload_path/profile/',
                    'new_image' => $files['name'],
                    'file_type' => $files['type'],
                    'filesize' => $files['size'],
                );
            $this->Mstorage->insert_entry($img);      
        }
        
    }
    function address_update_post() {
        $contact = array(
            'id'=>$this->post('member_id'),
            'email_address'=>$this->post('email'),
            'contact_no'=>$this->post('contact_no')
        );        
        
        $input = $this->input->post();
        $input =array_diff_key($input, $contact);
        $this->Mmember->update_entry($contact);
        $input['id'] = $this->post('id');
        $this->Maddress->update_entry($input);
        $message = array('result' => TRUE, 'data' => $this->input->post(), 'message' => 'UPDATED!');

        $this->response($message, 200); // 200 being the HTTP response code
    }
    function chang_pass_post() {
        $pass = array(
                'id'=>$this->post('id'),
                'password'=>$this->post('new_password')
               );
        $return = $this->Mmember->has_pass($pass);
        if($return){
            $pass = array(
                'id'=>$this->post('id'),
                'password'=>$this->post('new_password')
               );
            $this->Mmember->update_entry($contact);
            $message = array('result' => TRUE, 'data' => $this->input->post(), 'message' => 'UPDATED!');
        }else{
            $message = array('result' => FALSE);
        }
        $this->response($message, 200); // 200 being the HTTP response code
        
    }
    function user_delete() {
        //$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');

        $this->response($message, 200); // 200 being the HTTP response code
    }

    function users_get() {
        //$users = $this->some_model->getSomething( $this->get('limit') );
        $users = array(
            array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
            array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
            3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => array('hobbies' => array('fartings', 'bikes'))),
        );

        if ($users) {
            $this->response($users, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function send_post() {
        var_dump($this->request->body);
    }

    public function send_put() {
        var_dump($this->put('foo'));
    }

}
