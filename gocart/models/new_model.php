<?php
Class New_model extends CI_Model
{

	/********************************************************************
	New functions
	********************************************************************/
	function get_news()
	{
		$this->db->order_by('sequence', 'ASC');
		$result = $this->db->get('news')->result();
		
		$return	= array();
		foreach($result as $new)
		{

			// Set a class to active, so we can highlight our current page
			if($this->uri->segment(1) == $new->slug) {
				$new->active = true;
			} else {
				$new->active = false;
			}

			$return[$new->id]				= $new;			
		}
		
		return $return;
	}

	function get_news_tiered()
    {
		$this->db->order_by('sequence', 'ASC');
		$this->db->order_by('title', 'ASC');
		$news = $this->db->get('news')->result();
		
		$results	= array();		
		
		return $results;
	}

	function get_new($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->get('news')->row();
		
		return $result;
	}
	
	function get_slug($id)
	{
		$new = $this->get_new($id);
		if($new) 
		{
			return $new->slug;
		}
	}
	
	function save($data)
	{
		if($data['id'])
		{
			$this->db->where('id', $data['id']);
			$this->db->update('news', $data);
			return $data['id'];
		}
		else
		{
			$this->db->insert('news', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_page($id)
	{
		//delete the page
		$this->db->where('id', $id);
		$this->db->delete('news');
	
	}
	
	function get_new_by_slug($slug)
	{
		$this->db->where('slug', $slug);
		$result = $this->db->get('news')->row();
		
		return $result;
	}
}