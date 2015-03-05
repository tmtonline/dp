<?php
Class Price_Lists_Model extends CI_Model
{

	/********************************************************************
	price Custom functions
	********************************************************************/
	function __construct()
	{
			parent::__construct();
	}	
	
	function get_list()
	{		
		$res = $this->db->get('price_lists');
		return $res->result_array();
	}
	
	function get_price($id)
	{
		$res = $this->db->where('id', $id)->get('price_lists');
		return $res->row_array();
	}
	
	function save_price($data)
	{		
		if(!empty($data['id']) && isset($data['id']))
		{
			$this->db->where('id', $data['id'])->update('price_lists', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('price_lists', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_price($id)
	{
		$this->db->where('id', $id)->delete('price_lists');
		return $id;
	}
	
	function display_one_price()
	{
		$res = $this->db->where('status', 'Enable')->order_by('sequence',"ASC")->get('price_lists');				
		return $res->result_array();
	}
	
	
	
}