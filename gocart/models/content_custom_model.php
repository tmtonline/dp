<?php
Class Content_Custom_Model extends CI_Model
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
		$res = $this->db->get('content_custom');
		return $res->result_array();
	}
	
	function get_content($id)
	{
		$res = $this->db->where('id', $id)->get('content_custom');
		return $res->row_array();
	}
	
	function save_content($data)
	{
		if($data['id'])
		{
			$this->db->where('id', $data['id'])->update('content_custom', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('content_custom', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_content($id)
	{
		$this->db->where('id', $id)->delete('content_custom');
		return $id;
	}
	
	function display_one_content()
	{
		$res = $this->db->order_by('id',"DESC")->limit(1)->get('content_custom');				
		return $res->row_array();
	}
	
	
	
}