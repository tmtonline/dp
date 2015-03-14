<?php
class Weekend_Schedule extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->auth->check_access('Admin', true);
		$lang = $this->session->userdata('lang');
		$this->load->model(array('weekend_schedule_model', 'Admin_model', 'team_model'));
		//load the admin language file in
		$this->lang->load('weekend_schedule', $lang);				
	}

	function index()
	{
		$data['page_title']	= lang('weekend_schedules');
		$data['schedules']		= $this->weekend_schedule_model->schedules();				
		$this->view($this->config->item('admin_folder').'/schedules', $data);
	}

	
	/********************************************************************
	 delete weekend_schedule
	********************************************************************/
	function delete($id)
	{	
		$weekend_schedule	= $this->weekend_schedule_model->schedules($id);
	
		if($weekend_schedule)
		{
			$this->weekend_schedule_model->delete_weekend_schedule($id);
			$this->session->set_flashdata('message', lang('message_deleted_weekend_schedule'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
	
		redirect($this->config->item('admin_folder').'/weekend_schedule');
	}
				
	function form($id = false)
	{	
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$data['page_title']		= lang('weekend_schedule_setting');
		//here is direct read admin with staff access, no need join table
		$data['staffs']					= $this->Admin_model->get_staffs();
		$data['teams']					= $this->team_model->get_all_teams();
	
		//default values are empty if the weekend_schedule is new
		$data['id']			= '';
		$data['teamID']		= '';
		$data['staffID']	= '';		
		
		// passing teamID to get whole staff list
		if ($id)
		{	
			$weekend_schedules			= $this->weekend_schedule_model->schedules($id);
			
			
			//if the administrator does not exist, redirect them to the admin list with an error
			if (!$weekend_schedules)
			{
				$this->session->set_flashdata('message', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/weekend_schedule');
			}
			//set values to db values
			//$data['id']				= $weekend_schedule->id;
			//$data['teamID']			= $weekend_schedule->teamID;
			//$data['staffID']		= $weekend_schedule->staffID;
			$data['weekend_schedules'] = $weekend_schedules;
			$staffs = array();
			
			foreach($weekend_schedules as $weekend_schedule):
				array_push($staffs, $weekend_schedule->staffID);
			endforeach;
			$data['staff_list'] = $staffs;			
		}
		
		
		
		$this->form_validation->set_rules('teamID', 'lang:team', 'trim|required');
		$this->form_validation->set_rules('staffID', 'lang:staff', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/schedule_setting', $data);
		}
		else
		{			
			$arr_staffID	= $this->input->post('staffID');			
			$teamID 		= $this->input->post('teamID');
			
			//delete weekend by teamID first
			$this->weekend_schedule_model->delete_weekend_schedule($teamID);
			//ngieu(many) data saved					
			foreach ($arr_staffID as $key => $value)
			{
				$save = array(
						'staffID' => $value,
						'teamID' => $teamID
				);
			    $this->weekend_schedule_model->save_weekend_schedule($save);
			}											
			
			$this->session->set_flashdata('message', lang('message_weekend_schedule_saved'));			
			//go back to the customer list
			redirect($this->config->item('admin_folder').'/weekend_schedule');
		}
	}

}