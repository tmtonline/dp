<?php
Class Weekend_Schedule_model extends CI_Model
{				
	function get_staff_schedule($staff_id = '')
	{					
		$this->db->where('staffID', $staff_id);				
		return $this->db->get('weekend_schedule')->row();		
	}
	
	function schedules($team_id = '')
	{
		if(empty($team_id))
		{
			//if nothing is provided return the whole shabang
			return $this->get_all_schedules();
		}
		else
		{
			//grab the limit
			if(!empty($team_id))
			{
				$this->db->where('teamID', $team_id);
			}
																
			return $this->db->get('weekend_schedule')->result();							
		}
	}
	
	function get_all_schedules()
	{				
		$this->db->select("* , team.name as teamName, GROUP_CONCAT(concat(admin.firstname,' ',admin.lastname) SEPARATOR ',') as staffID", false);
		$this->db->from('weekend_schedule');
		$this->db->join('admin', 'admin.id = weekend_schedule.staffID', 'LEFT');	
		$this->db->join('team', 'weekend_schedule.teamID = team.id', 'LEFT');
		$this->db->group_by('weekend_schedule.teamID');				
		//sort by alphabetically by default
		$this->db->order_by('weekend_schedule.id', 'ASC');				
		$result	= $this->db->get(); 		
		return $result->result();
	}
	
	//weekend type
	function get_all_weekend_type()
	{
		//sort by alphabetically by default
		$this->db->order_by('id', 'ASC');
		$result	= $this->db->get('weekend_schedule');
	
		return $result->result();
	}
	
	function delete_weekend_schedule($id)
	{
		$this->db->where('teamID', $id)->delete('weekend_schedule');
		return $id;
	}
	
	function save_weekend_schedule($data)
	{
		if(!empty($data['id']) && isset($data['id']))
		{
			$this->db->where('id', $data['id'])->update('weekend_schedule', $data);
			return $data['id'];
		}
		else
		{
			$this->db->insert('weekend_schedule', $data);
			return $this->db->insert_id();
		}
	}
	
}