<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mmarketing
 *
 * @author dd
 */
class Mmarketing extends CI_Model {
    
    var $table = 'marketing';
    var $column_order = array('first_name','last_name',null,'created_at'); //set column field database for datatable orderable
    var $column_search = array('identification','first_name','last_name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'desc'); // default order 
    public function entry_insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function entry_update($where, $data)
    {
        $this->db->where('id', $where);
        $this->db->update($this->table,$data);
        return $this->db->affected_rows();
    }
    public function get__by_identification($id,$course_id)
    {
        $this->db->from($this->table);
        $this->db->where('course_location_id',$course_id);
        $this->db->where('identification',$id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }
    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }
    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
    public function count_all_by_course()
    {
        $sesion = $this->session->userdata('admin');
        $this->db->from($this->table);
        if($sesion['permission_id']==2){
            $this->db->where('admin_id',$sesion['id']);
        }
        $this->db->where('marketing.course_location_id', $_POST['course_location_id']);
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
        $sesion = $this->session->userdata('admin');
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        if($sesion['permission_id']==2){
            $this->db->where('admin_id',$sesion['id']);
        }
        $this->db->where('marketing.course_location_id', $_POST['course_location_id']);
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
}
