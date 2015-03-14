<?php
Class Admin_model extends CI_Model
{			
	function admin($admin_id)
	{
		$this->db->where('id', $admin_id);
		$result = $this->db->get('admin');
		$result = $result->row();				
		return $result;		
	}	
	
	function get_staffs()
	{
		$this->db->where('access', 'staff');
		$result = $this->db->get('admin');
		return $result->result();		
	}
	
}