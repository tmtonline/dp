<?php

class lang extends Admin_Controller {

	function change_lang($type){		
		$this->session->set_userdata("lang", $type);		
		redirect($_SERVER['HTTP_REFERER']);
	}
	   

}