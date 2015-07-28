<?php
class Team extends Admin_Controller

{
	protected $activemenu 	= 'team';
	
	function __construct()
	{
		parent::__construct();
		$this->auth->check_access('Admin', true);
		$lang = $this->session->userdata('lang');
		$this->load->model('team_model');
		//load the admin language file in
		$this->lang->load('team', $lang);				
	}

	function index()
	{
		
		$data['page_title']	= lang('teams');
		$data['teams']		= $this->team_model->teams();
	
		$this->view($this->config->item('admin_folder').'/teams', $data);
	}

	
	/********************************************************************
	 delete team
	********************************************************************/
	function delete($id)
	{
		
	
		$team	= $this->team_model->teams($id);
	
		if($team)
		{
			$this->team_model->delete_team($id);
			$this->session->set_flashdata('message', lang('message_deleted_team'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
	
		redirect($this->config->item('admin_folder').'/team');
	}
		
	function form($id = false)
	{	
		$data['activemenu'] 		= $this->activemenu;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$data['page_title']		= lang('team_setting');
		
		//default values are empty if the team is new
		$data['id']			= '';
		$data['name']		= '';
		$data['desc']		= '';
		$data['weekendID']	= '';
		
		if ($id)
		{	
			$team			= $this->team_model->team($id);
			//if the administrator does not exist, redirect them to the admin list with an error
			if (!$team)
			{
				$this->session->set_flashdata('message', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/team');
			}
			//set values to db values
			$data['id']				= $team->id;
			$data['name']			= $team->name;
			$data['desc']			= $team->desc;
			$data['weekendID']		= $team->weekendID;
		}
		
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('desc', 'lang:desc', 'trim');
		$this->form_validation->set_rules('weekendID', 'lang:weekend_type', 'trim|required');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/team_setting', $data);
		}
		else
		{
			$save['id']		= $id;
			$save['name']		= $this->input->post('name');
			$save['desc']		= $this->input->post('desc');
			$save['weekendID']	= $this->input->post('weekendID');
			
			$this->team_model->save_team($save);
			
			$this->session->set_flashdata('message', lang('message_team_saved'));
			
			//go back to the customer list
			redirect($this->config->item('admin_folder').'/team');
		}
	}

}