<?php
Class Outlet_Model extends CI_Model
{

	/********************************************************************
	outlet Custom functions
	********************************************************************/
	function __construct()
	{
			parent::__construct();
	}	
	
	function outlets($data=array(), $return_count=false)
	{
		if(empty($data))
		{
			//if nothing is provided return the whole shabang
			$this->get_all_outlets();
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
					$this->db->like('outlet', $search->term);
					$this->db->or_like('address', $search->term);
					$this->db->or_like('contact', $search->term);					
				}	
			}
				
			if($return_count)
			{
				return $this->db->count_all_results('outlets');
			}
			else
			{
				return $this->db->get('outlets')->result();
			}
				
		}
	}
	
	function get_all_outlets()
	{
		//sort by alphabetically by default
		$this->db->order_by('zone_id', 'ASC');
		$result	= $this->db->get('outlets');	
		return $result->result();
	}
	
	function get_list()
	{		
		$res = $this->db->get('outlets');
		return $res->result_array();
	}
	
	function get_outlet($id)
	{
		$res = $this->db->where('id', $id)->get('outlets');
		return $res->row_array();
	}
	
	function save_outlet($data)
	{		
		if(!empty($data['id']) && isset($data['id']))
		{
			$this->db->where('id', $data['id'])->update('outlets', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('outlets', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_outlet($id)
	{
		$this->db->where('id', $id)->delete('outlets');
		return $id;
	}
	
	function display_one_outlet()
	{
		$res = $this->db->where('status', 'Enable')->order_by('sequence',"ASC")->get('outlets');				
		return $res->result_array();
	}
	

	/*Outlet for Company*/
	function get_outlets($zone_id)
	{
		$this->db->where('zone_id', $zone_id);
		$this->db->order_by('outlet', 'ASC');
		return $this->db->get('outlets')->result();
	}
	
	function get_outlet_states()
	{
		$this->db->join("country_zones", "zone_id=country_zones.id");
		$res = $this->db->group_by("zone_id")->get('outlets');
		return $res->result_array();
	}
	
	
	
}