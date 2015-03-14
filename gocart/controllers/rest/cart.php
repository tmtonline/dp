<?php 
require_once(APPPATH.'/libraries/REST_Controller.php');

class Cart extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Gallery_model'));
		
		$this->load->library('email',array(
       	'mailtype'  => 'html',
        	'newline'   => '\r\n'
		));
	}
	
	function get_gallery()
	{		
		return $this->Gallery_model->display_one_gallery();		
	}
}
?>