<?php
/*

 - DB STRUCTURE
comment
	id  (int)
	name (varchar)
	company_name (varchar)
	email_address (varchar)
	telephone_number (varchar)
	facsimile_number (varchar)		
	address (text)
	city (varchar)		
	state (varchar)
	postcode (varchar)	
	country_id (int)
	comment (text)
		
*/

class Message_model extends CI_Model 
{
	//member used
	function save_comment($data)
	{
		if(!empty($data['id']))
		{
			$this->db->where('id', $data['id'])->update('comment', $data);
			return $data['id'];
		} else {
			$this->db->insert('comment', $data);
			return $this->db->insert_id();
		}
	}
	
	function save($message)
	{
		if(!$message['id']) 
		{
			return $this->add_message($message);
		} 
		else 
		{
			$this->update_message($message['id'], $message);
			return $message['id'];
		}
	}

	// add message, returns id
	function add_message($data) 
	{
		$this->db->insert('comment', $data);
		return $this->db->insert_id();
	}
	
	// update message
	function update_message($id, $data)
	{
		$this->db->where('id', $id)->update('comment', $data);
	}
	
	// delete message
	function delete_message($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('comment');			
	}				
	
	// get messages list, sorted by start_date (default), end_date
	function get_messages($sort=NULL) 
	{		
		return $this->db->get('comment')->result();
	}
	
	// get message details, by id
	function get_message($id)
	{
		return $this->db->where('id', $id)->get('comment')->row();
	}
				
	
}	
