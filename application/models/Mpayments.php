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
    var $table = 'payments';
    var $column_order = array(null,'applicantion.app_code',null,null,null,null,null,null); //set column field database for datatable orderable
    var $column_search = array('applicantion.app_code','member.first_name','admin.first_name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('payments.id' => 'desc'); // default order 
    public function count_all()
    {        
        $this->db->select("*,payments.id as payments_id");
        $this->db->join('applicantion','applicantion.id=payments.application_id');
        $this->db->where_not_in('applicantion.application_flow_id',array(2,6,10));
        $this->db->from($this->table);
        if($_GET['unpaid']=='true'){
            $this->db->where('is_payment',null);
        }else{
            $this->db->where('is_payment IS NOT NULL', NULL, FALSE);            
        }                
        return $this->db->count_all_results();
    }
    private function _get_datatables_query()
    {         
        
        $this->db->from($this->table); 
        if($_GET['unpaid']=='true'){
            $this->db->where('is_payment',null);
        }else{
            $this->db->where('is_payment IS NOT NULL', NULL, FALSE);            
        } 
        $i = 0;     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(!empty($_POST['marketing'])){
            $this->db->like('applicantion.admin_id', $_POST['marketing']);
        }         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        if($_GET['unpaid']=='true'){
            $this->db->where('is_payment',null);
        }else{
            $this->db->where('is_payment IS NOT NULL', NULL, FALSE);            
        } 
        $this->_get_datatables_query();
        $sesion = $this->session->userdata('admin');
        if($_POST['length'] != -1)   
        $this->db->select("*,payments.id as payments_id,member.first_name member_first_name");
        $this->db->join('applicantion','applicantion.id=payments.application_id');
        $this->db->join('member','member.id=payments.member_id');        
        $this->db->where_not_in('applicantion.application_flow_id',array(2,6,10));
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
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
