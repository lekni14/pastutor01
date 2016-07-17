<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mmember
 *
 * @author NiponRoom
 */
class Mmember extends CI_Model {
    
    var $table = 'member';   
    var $column_order = array('member_code','identification','first_name','nickname',null,null,null,'create_at',null,); //set column field database for datatable orderable
    var $column_search = array('identification','first_name','last_name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'desc'); // default order 
    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        // load model
        $this->load->model(array('Maddress','Mschool','Mstorage'));
    }
    public function count_all_by_course()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    } 
    private function _get_datatables_query()
    {         
        $this->db->from($this->table); 
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
        $this->_get_datatables_query();
        if($_POST['length'] != -2)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function get_by_id($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('member');        
        if ($query->num_rows() > 0) {
            return $query->row_array();;
        } else {
            return false;
        }
    }
    public function login($data)
    {
        $this->db->where('identification',$data['identification']);
        $this->db->where('password',$data['password']);
        $query = $this->db->get('member');        
        if ($query->num_rows() == 1) {
            $this->session->set_userdata('login',$query->row_array());
            return true;
        } else {
            return false;
        }
    }
    public function has_pass($data)
    {
        $this->db->where('id',$data['id']);
        $this->db->where('password',md5($data['password']));
        $query = $this->db->get('member');
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function insert_entry($data)
    {
        $this->db->insert('member', $data);        
        $insert_id = $this->db->insert_id();
        $data['id'] = $insert_id;
        $this->session->set_userdata('login',$data);
        return  $insert_id;
    }
    public function update_entry($data)
    {
        $this->db->where('id',$data['id']);
        $this->db->update('member',$data);
    }
    public function getMember($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('member');
        if($query->num_rows() >0){
            $return =  $query->row_array();
            $return['address'] = $this->Maddress->getAddress($id);
            $return['school'] = $this->Mschool->getSchoolByID($return['school_id']);
            $return['storage'] = $this->Mstorage->getFileByFID($id,2);   
            return $return;
        }else{
            
        }
    }
    public function getMemberAll()
    {
        $this->db->select('*');
        $this->db->select('member.id as id,member_level.id as member_level_id');
        $this->db->join('member_level','member_level.id=member.levelID');
        $query = $this->db->get('member');
        if($query->num_rows() >0){
            $return =  $query->result_array();
            foreach ($query->result_array() as $key => $value) {
                $return[$key]['address'] = $this->Maddress->getAddress($value['id']);
                $return[$key]['school'] = $this->Mschool->getSchoolByID($value['school_id']);                
            }            
            return $return;
        }else{
            return FALSE;
        }
        
    }
    public function getMemberByIdentification($identification)
    {
        $this->db->where('identification',$identification);
        $query = $this->db->get('member');
        if ($query->num_rows() >0) {
            $return =  $query->row_array();
            $return['address'] = $this->Maddress->getAddress($return['id']);
            $return['school'] = $this->Mschool->getSchoolByID($return['school_id']);
            return $return;
        } else {
            return false;
        }        
    }
    public function getLastId()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('member');
        return $query->row_array();
    }
    public function hasIdentification($Identification)
    {
        $this->db->where('identification', $Identification);
        $query = $this->db->get('member');
        if ($query->num_rows() >0) {
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
}
