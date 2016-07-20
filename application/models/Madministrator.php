<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Madministrator
 *
 * @author dd
 */
class Madministrator extends CI_Model {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        // load model
        $this->load->model(array('Mpermission'));
    }
    public function login($data)
    {
        $this->db->where('active',1);
        $this->db->where('username',$data['username']);
        $this->db->where('password',$data['password']);
        $query = $this->db->get('administrator');
        if ($query->num_rows() == 1) {
            $return = $query->row_array();
            $return['permission'] = $this->Mpermission->getPermission($return['permission_id']);
            $this->session->set_userdata('admin',$return);
            return true;
        } else {
            return false;
        }
    }
    public function getAdminAll()
    {
        $this->db->order_by('id','DEAC');
        //$this->db->where('active',1);
        $query = $this->db->get('administrator');
        if ($query->num_rows() >0) {
            $return = $query->result_array();
            foreach ($return as $key => $value):
                $return[$key]['permission'] = $this->Mpermission->getPermission($value['permission_id']);
            endforeach;
            return $return;
        } else {
            return false;
        }
    }
    public function insert_entry($data)
    {
        $this->db->insert('administrator', $data);
        $insert_id = $this->db->insert_id();
        //$data['id'] = $insert_id;
        //$this->session->set_userdata('login',$data);
        return  $insert_id;
    }
    public function update_entry($data)
    {
        $this->db->where('id',$data['id']);
        $this->db->update('administrator',$data);
    }
    public function getById($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('administrator');
        if ($query->num_rows() == 1) {
            $return = $query->row_array();
            $return['permission'] = $this->Mpermission->getPermission($return['permission_id']);
            return $return;
        } else {
            return false;
        }
    }

    public function haspass($data)
    {
        $this->db->where('id',$data['id']);
        $this->db->where('password',$data['password']);
        $query = $this->db->get('administrator');
        if ($query->num_rows() >0) {
            return true;
        } else {
            return false;
        }
    }
    public function getLastId($permission_id)
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('permission_id',$permission_id);
        $query = $this->db->get('administrator');
        return $query->row_array();
    }
    public function get_by_email($email)
    {
        $this->db->where('email',$email);
        $query = $this->db->get('administrator');
        if ($query->num_rows() >0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
    function get_marketing_acive()
    {
        $this->db->where('active',1);
        $this->db->where('permission_id',2);
        $query = $this->db->get('administrator');
        return $query->result_array();
    }
}
