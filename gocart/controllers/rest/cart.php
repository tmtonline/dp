<?php 
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require_once(APPPATH.'/libraries/REST_Controller.php');

class Cart extends REST_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model(array('Banner_model','content_custom_model','Sidebar_model','profile_model','gallery_model'));
		
		$this->load->library('email',array(
       	'mailtype'  => 'html',
        	'newline'   => '\r\n'
		));
	}
	
	function user_get()
	{		
		return $this->gallery_model->display_one_gallery();		
	}
	
	function tmt_gallery_get()
	{
		/* //$galleries = $this->Gallery_model->display_one_gallery();	
		return  $this->Gallery_model->display_one_gallery();
		//$this->response($galleries); */
		$galleries = $this->gallery_model->display_one_gallery();
		
		//$data = array('returned: '. $this->get('id'));
		$this->response($galleries);
		
	}
}
?>