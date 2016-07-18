<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Administrator
 *
 * @author dd
 */
class Administrator extends CI_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        // load model
        $this->load->model(array('Madministrator','Mmember'));
    }
    public function index()
    {
        //$this->load->view('admin/template/index');

        if($this->session->has_userdata('admin')){
            $this->load->view('admin/template/index');
        }else{
            redirect('administrator/login');
        }
    }
    public function login()
    {
        if($this->session->has_userdata('admin')){
            redirect('administrator/payment');
        }else{
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required',
                        array('required' => 'You must provide a %s.')
                );
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('admin/login');
            }
            else
            {
                $login = array('username'=>  $this->input->post('username'),'password'=>  $this->input->post('password'));
                $retuen = $this->Madministrator->login($login);
                if($retuen){
                    redirect('administrator');
                }else{
                    $data = array(
                        'error_message' => 'Invalid Username or Password'
                        );
                    $this->load->view('admin/login',$data);
                }
                //$this->load->view('formsuccess');
            }
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('administrator/login');
    }
    public function staff_index()
    {
        $this->load->library('breadcrumbs');
        if ($this->session->has_userdata('admin')) {
            $data['admin'] = $this->Madministrator->getAdminAll();
//            print_r($data);
//            exit();
            $this->breadcrumbs->staff_index();
            $this->load->view('admin/member/staff_index',$data);
        } else {
            redirect('administrator/login');
        }

    }
    public function staff_create()
    {
        $this->load->library('breadcrumbs');
        if ($this->session->has_userdata('admin')) {
            $this->breadcrumbs->staff_create();
            $this->load->view('admin/member/staff_create');
        } else {
            redirect('administrator/login');
        }

    }
    public function data_create()
    {
        $this->load->library('generate');
        $data = array(
            'first_name'=>$this->input->post('first_name'),
            'last_name'=>$this->input->post('last_name'),
            'permission_id'=>$this->input->post('permission_id'),
            'email'=>$this->input->post('email'),
            'phon'=>$this->input->post('phon'),
            'username'=>  $this->generateuser($this->input->post('permission_id')),
            'password'=>$this->generate->random_password(8),
            'active'=>$this->input->post('active'),
            'created_at'=>  date('Y-m-d H:i:s'),
            'updated_at'=>  date('Y-m-d H:i:s'),

            );
        $this->Madministrator->insert_entry($data);
        $arr['admin'] = $data;
        $arr['subject'] = "แจ้งรหัสผ่านทีมงาน";
        $arr['message'] = $this->load->view('admin/template/email-create-user',$data,TRUE);
        $this->sendMail($arr);
        echo json_encode(array('result'=>TRUE));
    }
    public function data_edit()
    {
        $data = array(
            'id'=>$this->input->post('id'),
            'first_name'=>$this->input->post('first_name'),
            'last_name'=>$this->input->post('last_name'),
            'permission_id'=>$this->input->post('permission_id'),
            'email'=>$this->input->post('email'),
            'phon'=>$this->input->post('phon'),
            'active'=>$this->input->post('active'),
            'updated_at'=>  date('Y-m-d H:i:s'),
            );
        $this->Madministrator->update_entry($data);
        echo json_encode(array('result'=>TRUE));
    }
    public function generateuser($permission_id)
    {
        $retrun = $this->Madministrator->getLastId($permission_id);
        $maxId = $retrun['id'];
        $maxId = ($maxId + 1);
        if($permission_id==1){
            return 'admin'.$maxId;
        }else{
            return 'martketing'.$maxId;
        }
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
        $this->email->to($data['admin']['email']);// change it to yours
        $this->email->subject($data['subject']);
        $this->email->message($data['message']);
        if ($this->email->send()) {
            $msg = array('result'=>TRUE);
        } else {
            show_error($this->email->print_debugger());
        }
    }
    public function staff_edit($id)
    {
        $this->load->library('breadcrumbs');
        if ($this->session->has_userdata('admin')) {
            $this->breadcrumbs->staff_edit();
            $data['admin'] = $this->Madministrator->getById($id);
            $this->load->view('admin/member/staff_edit',$data);
        } else {
            redirect('administrator/login');
        }
    }
    public function forget_password() {
        $data['admin'] = $this->Madministrator->get_by_email($this->input->post('email'));
        if($data['admin']){
            $data['subject'] = "แจ้งการลืมรหัสผ่าน";
            $data['message'] = $this->load->view('admin/template/email-forget-pass',$data,TRUE);
            $this->sendMail($data);
            $this->session->set_flashdata('msg', 'โปรดตรวจสอบอีเมล');
            $this->session->set_flashdata('success', 'success');
        }else{
            $this->session->set_flashdata('error', 'error');
            $this->session->set_flashdata('error', 'โปรดลองอีกครั้ง');
        }
        redirect('administrator/login');
    }
    //public function 
}
