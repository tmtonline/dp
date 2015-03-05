<?php
Class Ticket_model extends CI_Model
{

	function get_ticket($code)
    {
        return $this->db->get_where('tickets', array('code'=>$code))->row();
    }
    
    function save($ticket)
    {
        if ($ticket['id'])
        {
            $this->db->where('id', $ticket['id']);
            $this->db->update('categories', $ticket);
            
            return $ticket['id'];
        }
        else
        {
            $this->db->insert('tickets', $ticket);
            return $this->db->insert_id();
        }
    }
    
    function delete($code)
    {
        $this->db->where('code', $code);
        $this->db->delete('tickets');               
    }
}