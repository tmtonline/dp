<?php
Class Profile_Model extends CI_Model
{

	/********************************************************************
	profile Custom functions
	********************************************************************/
	function __construct()
	{
			parent::__construct();
	}	
			
	function get_profile($id)
	{
		$res = $this->db->where('id', $id)->get('profile');
		return $res->row_array();
	}
	
	function save_profile($data)
	{								
		if(!empty($data['id']) && isset($data['id']))
		{
			$this->db->where('id', $data['id'])->update('profile', $data);
			return $data['id'];
		}
		else
		{
			/* $this->db->insert('profile', $data);
			return $this->db->insert_id(); */
		}
		
		
	}	
	
	
	
	
}