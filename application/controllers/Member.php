<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Member
 *
 * @author NiponRoom
 */
class Member extends CI_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        // load model
        $this->load->model(array('Mmember', 'Maddress'));
    }

    public function regiter() {
        $this->load->view('modal/md-regiter');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('index');
    }

    public function member_profile($id) {
        if (!$this->session->has_userdata('login')) {
            redirect('index');
        } else {
            $data['profile'] = $this->Mmember->getMember($id);
            $this->load->view('member/profile', $data);
        }
    }

    public function member_profile_edit($id) {
        if (!$this->session->has_userdata('login')) {
            redirect('index');
        } else {
            $data['profile'] = $this->Mmember->getMember($id);
            $this->load->view('member/profile-edit', $data);
        }
    }

    public function forget_password() {
        $data['profile'] = $this->Mmember->getMemberByIdentification($this->input->post('identification'));
        if($data['profile']){
            $data['profile']['email'] = $this->input->post('email');
            $this->sendMail($data);
            $msg = array('result'=>TRUE);
        }else{
            $msg = array('result'=>FALSE);
        }
        echo json_encode($msg);        
    }

    public function sendMail($data) {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',            
            'smtp_port' => 465,
            'smtp_user' => 'pastutor01@gmail.com', // change it to yours
            'smtp_pass' => 'pastutor', // change it to yours
            'mailtype' => 'html',
            'charset' => 'UTF-8',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('pastutor01@gmail.com'); // change it to yours
        $this->email->to($data['profile']['email']);// change it to yours
        $this->email->subject("แจ้งการลืมรหัสผ่าน");
        $this->email->message($this->load->view('template/email-forget-pass',$data,TRUE));      
        if ($this->email->send()) {
            $msg = array('result'=>TRUE);
        } else {
            show_error($this->email->print_debugger());
        }
    }

}
