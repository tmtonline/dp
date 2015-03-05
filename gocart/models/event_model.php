<?php
Class Event_Model extends CI_Model
{

	/********************************************************************
	event Custom functions
	********************************************************************/
	function __construct()
	{
			parent::__construct();
	}	
	
	function event($data=array(), $return_count=false)
	{
		if(empty($data))
		{
			//if nothing is provided return the whole shabang
			$this->get_all_event();
		}
		else
		{
			//grab the limit
			if(!empty($data['rows']))
			{
				$this->db->limit($data['rows']);
			}
				
			//grab the offset
			if(!empty($data['page']))
			{
				$this->db->offset($data['page']);
			}
				
			//do we order by something other than category_id?
			if(!empty($data['order_by']))
			{
				//if we have an order_by then we must have a direction otherwise KABOOM
				$this->db->order_by($data['order_by'], $data['sort_order']);
			}
				
			//do we have a search submitted?
			if(!empty($data['term']))
			{
				$search	= json_decode($data['term']);
				//if we are searching dig through some basic fields
				if(!empty($search->term))
				{
					$this->db->like('event', $search->term);
					$this->db->or_like('address', $search->term);
					$this->db->or_like('contact', $search->term);					
				}	
			}
				
			if($return_count)
			{
				return $this->db->count_all_results('event');
			}
			else
			{
				return $this->db->get('event')->result();
			}
				
		}
	}
	
	function get_all_event()
	{
		//sort by alphabetically by default
		$this->db->order_by('zone_id', 'ASC');
		$result	= $this->db->get('event');	
		return $result->result();
	}
	
	function get_list()
	{		
		$res = $this->db->get('event');
		return $res->result_array();
	}
	
	function get_event($id)
	{
		$res = $this->db->where('id', $id)->get('event');
		return $res->row_array();
	}
	
	function save_event($data)
	{						
		if(!empty($data['date']) && isset($data['date']))
		{
			$data['date'] = date('Y-m-d', strtotime($data['date']));
		}
		
		if(!empty($data['date_to']) && isset($data['date_to']))
		{
			$data['date_to'] = date('Y-m-d', strtotime($data['date_to']));
		}

		if(!empty($data['id']) && isset($data['id']))
		{
			$this->db->where('id', $data['id'])->update('event', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('event', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_event($id)
	{
		$this->db->where('id', $id)->delete('event');
		return $id;
	}
	
	function display_one_event()
	{
		$res = $this->db->where('status', 'Enable')->order_by('sequence',"ASC")->get('event');				
		return $res->result_array();
	}
	

	/*Event for Company*/
	function get_events()
	{
		$this->db->order_by('id', 'ASC');
		return $this->db->get('event')->result();
	}
	
	
	
	
}