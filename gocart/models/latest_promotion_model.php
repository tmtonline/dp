<?php
Class Latest_Promotion_Model extends CI_Model
{

	/********************************************************************
	promotion Custom functions
	********************************************************************/
	function __construct()
	{
			parent::__construct();
	}	
	
	function get_list()
	{		
		$res = $this->db->get('latest_promotion');
		return $res->result_array();
	}
	
	function get_promotion($id)
	{
		$res = $this->db->where('id', $id)->get('latest_promotion');
		return $res->row_array();
	}
	
	function save_promotion($data)
	{		
		if(!empty($data['id']) && isset($data['id']))
		{
			$this->db->where('id', $data['id'])->update('latest_promotion', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('latest_promotion', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_promotion($id)
	{
		$this->db->where('id', $id)->delete('latest_promotion');
		return $id;
	}
	
	function display_one_promotion()
	{
		$res = $this->db->where('status', 'Enable')->order_by('sequence',"ASC")->get('latest_promotion');				
		return $res->result_array();
	}
	
	
	
}