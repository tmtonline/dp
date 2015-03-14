<?php
Class Gallery_Model extends CI_Model
{

	/********************************************************************
	gallery Custom functions
	********************************************************************/
	function __construct()
	{
			parent::__construct();
			
	}	
	
	function get_list()
	{		
		$res = $this->db->get('gallery');
		return $res->result_array();
	}
	
	function get_gallery($id)
	{
		$res = $this->db->where('id', $id)->get('gallery');
		return $res->row_array();
	}
	
	function save_gallery($data)
	{		
		if(!empty($data['id']) && isset($data['id']))
		{
			$this->db->where('id', $data['id'])->update('gallery', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('gallery', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_gallery($id)
	{
		$this->db->where('id', $id)->delete('gallery');
		return $id;
	}
	
	function display_one_gallery()
	{
		$res = $this->db->where('status', 'Enable')->order_by('sequence',"ASC")->get('gallery');				
		return $res->result_array();
	}	
	
	function get_all()
	{
		$this->db->from('gallery');		
		return $this->db->get();
	}
	
	
	
}