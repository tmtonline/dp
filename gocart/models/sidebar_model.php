<?php
Class Sidebar_Model extends CI_Model
{

	/********************************************************************
	Content Custom functions
	********************************************************************/
	function __construct()
	{
			parent::__construct();
	}	
	
	function get_list()
	{		
		$res = $this->db->get('sidebar');
		return $res->result_array();
	}
	
	function get_content($id)
	{
		$res = $this->db->where('id', $id)->get('sidebar');
		return $res->row_array();
	}
	
	function save_content($data)
	{
		if($data['id'])
		{
			$this->db->where('id', $data['id'])->update('sidebar', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('sidebar', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_content($id)
	{
		$this->db->where('id', $id)->delete('sidebar');
		return $id;
	}
	
	function display_one_content()
	{
		$res = $this->db->order_by('id',"DESC")->limit(1)->get('sidebar');				
		return $res->row_array();
	}
	
	
	
}