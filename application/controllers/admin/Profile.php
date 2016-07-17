<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profile
 *
 * @author dd
 */
class Profile extends CI_Controller {
    function __construct() {
        // Construct the parent class
        parent::__construct();
        // load model
        $this->load->library('breadcrumbs');
        $this->load->model(array('Madministrator'));
    }
    public function index()
    {
        if($this->session->has_userdata('admin')){
            $this->breadcrumbs->profile_index();
            $this->load->view('admin/profile');
        }else{
            redirect('administrator/login');
        }
    }
    public function profile_update()
    {
        $input = array(
            'id'=>  $this->input->post('id'),
            'first_name'=>$this->input->post('first_name'),
            'last_name'=>$this->input->post('last_name'),
            'email'=>$this->input->post('email'),
            'phon'=>$this->input->post('phon'),
        );
        if($this->input->post('pasword')!=''){
            $input['password']=$this->input->post('password');
            if($this->Madministrator->haspass($input)){
                $input['password']=$this->input->post('newpassword');
                $this->Madministrator->update_entry($input);
                $msg = array('result'=>TRUE);
            }else{
                $msg = array('result'=>FALSE);
            }
        }else{
            $this->Madministrator->update_entry($input);
            $msg = array('result'=>TRUE);
        }     
        $this->session->set_userdata('admin',$this->Madministrator->getById($input['id']));
        echo json_encode($msg);
    }
}
