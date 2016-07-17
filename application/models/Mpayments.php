<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mpayments
 *
 * @author dd
 */
class Mpayments extends CI_Model {
    function __construct() {
        // Construct the parent class
        parent::__construct();
        // load model
        $this->load->model(array('Mmember','Mapplication'));
    }
    public function insert_entry($data)
    {
        $this->db->insert('payments', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function update_entry($data)
    {
        $this->db->where('id',$data['id']);
        $this->db->update('payments', $data);        
    }
    public function getPaymentByApp($data)
    {
        $this->db->order_by('id','DESC');
        $this->db->where('application_id', $data);
        $query = $this->db->get('payments');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }else{
            return FALSE;
        }
    }
    public function getPaymentAll()
    {
        $this->db->order_by('id','DESC');
        $this->db->where('is_payment IS NOT NULL', NULL, FALSE);
        $query = $this->db->get('payments');
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            foreach ($query->result_array() as $key => $value) {
                $return[$key]['member'] = $this->Mmember->getMember($value['member_id']);
                $return[$key]['application'] = $this->Mapplication->getApplicatoinByID($value['application_id']);
            }
            return $return;
        }else{
            return FALSE;
        }
    }
    public function getNoPaymentAll()
    {
        $this->db->order_by('id','DESC');
        $this->db->where('is_payment',null);
        $query = $this->db->get('payments');
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            foreach ($query->result_array() as $key => $value) {
                $return[$key]['member'] = $this->Mmember->getMember($value['member_id']);
                $return[$key]['application'] = $this->Mapplication->getApplicatoinByID($value['application_id']);
            }
            return $return;
        }else{
            return FALSE;
        }
    }
}
