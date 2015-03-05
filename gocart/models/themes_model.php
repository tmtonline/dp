<?php
Class Themes_Model extends CI_Model
{

	/********************************************************************
	event Custom functions
	********************************************************************/
	function __construct()
	{
			parent::__construct();
	}	
	
	
	function themes()
	{
		//sort by alphabetically by default	
		$result	= $this->db->get('themes');	
		return $result->result();
	}
	
	
	
	
}