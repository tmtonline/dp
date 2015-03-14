<?php
Class Team_model extends CI_Model
{			
	
	function team($team_id = '')
	{					
		$this->db->where('id', $team_id);				
		return $this->db->get('team')->row();		
	}
	
	function teams($team_id = '')
	{
		if(empty($team_id))
		{
			//if nothing is provided return the whole shabang
			return $this->get_all_teams();
		}
		else
		{
			//grab the limit
			if(!empty($team_id))
			{
				$this->db->where('id', $team_id);
			}
																
			return $this->db->get('team')->result();							
		}
	}
	
	function get_all_teams()
	{
		//sort by alphabetically by default
		$this->db->order_by('name', 'ASC');
		$result	= $this->db->get('team');
		
		return $result->result();
	}
	
	//weekend type
	function get_all_weekend_type()
	{
		//sort by alphabetically by default
		$this->db->order_by('id', 'ASC');
		$result	= $this->db->get('weekend_type');
	
		return $result->result();
	}
	
	function delete_team($id)
	{
		$this->db->where('id', $id)->delete('team');
		return $id;
	}
	
	function save_team($data)
	{
		if(!empty($data['id']) && isset($data['id']))
		{
			$this->db->where('id', $data['id'])->update('team', $data);
			return $data['id'];
		}
		else
		{
			$this->db->insert('team', $data);
			return $this->db->insert_id();
		}
	}
	
}