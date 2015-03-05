<?php
Class Memberships_Model extends CI_Model
{

	/********************************************************************
	Membership Custom functions
	********************************************************************/
	function __construct()
	{
			parent::__construct();
	}	
	
	function get_list()
	{		
		$res = $this->db->get('memberships');
		return $res->result_array();
	}
	
	function get_memberships($id)
	{
		$res = $this->db->where('id', $id)->get('memberships');
		return $res->row_array();
	}
	
	function save_memberships($data)
	{		
		if(!empty($data['id']) && isset($data['id']))
		{
			$this->db->where('id', $data['id'])->update('memberships', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('memberships', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_memberships($id)
	{
		$this->db->where('id', $id)->delete('memberships');
		return $id;
	}
	
	function display_one_memberships()
	{
		$res = $this->db->where('status', 'Enable')->order_by('sequence',"ASC")->get('memberships');				
		return $res->result_array();
	}
	
	
	
}