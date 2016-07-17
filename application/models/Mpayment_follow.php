<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mpayment_follow
 *
 * @author dd
 */
class Mpayment_follow extends CI_Model {
    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        // load model
        $this->load->model(array('Madministrator'));
    }
    public function entry_insert($data)
    {
        $this->db->insert('payment_follow', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function getFollowByCourse($application_id)
    {
        $this->db->where('application_id',$application_id);
        $this->db->from('payment_follow');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $return = $query->result_array();
            foreach ($query->result_array() as $key => $value) {
                $return[$key]['admin'] = $this->Madministrator->getById($value['admin_id']);                
            }
            return $return;
        }else{
            return FALSE;
        }
    }
}
