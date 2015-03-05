<?php
class Themes extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);
		$this->load->model('themes_model');
		$this->load->model('settings_model');
		$lang = $this->session->userdata('lang');
		$this->lang->load('themes', $lang);	
		$this->load->helper('form');
	}
		
	function index()
	{
		$data['themes_title']	= lang('themes');
		/* $data['event']		= $this->event_model->get_list(); */	
		$this->load->library('form_validation');
	
		$data['themes']	= $this->themes_model->themes();	
		$data['current_theme']	= $this->settings_model->current_theme();				
		
		//set values to db values
								
		$submitted		= $this->input->post('submit');
		
		if($submitted){
			$this->form_validation->set_rules('theme', 'lang:theme', 'trim|required');
			
			// Validate the form
			if($this->form_validation->run() == false)
			{
				$this->view($this->config->item('admin_folder').'/themes_form', $data);
			}
			else
			{
				
			}			
			
			$save['setting']		= $this->input->post('theme');			
			$this->settings_model->change_themes($save);			
			//go back to the event list
			redirect($this->config->item('admin_folder').'/themes');
			
		}
												
		$this->view($this->config->item('admin_folder').'/themes_form', $data);
	}
	
	
	/********************************************************************
	edit event
	********************************************************************/
	function form($id = false)
	{
		$this->load->helper('url');
		$this->load->helper('form');
						
		$config['upload_path']		= 'uploads';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);
		$this->load->library('form_validation');
		//set the default values
		$data['id']			= '';
		$data['date']	= '';
		$data['date_to']	= '';
		$data['time']		= '';
		$data['time_to']		= '';
		$data['event']	= '';
		$data['venue']	= '';
		$data['status']		= '';		
		$data['brands']		= '';
		$data['event_title']	= lang('event_form');
		
		if($id)
		{
			
			$event			= $this->event_model->get_event($id);
			
			if(!$event)
			{
				//event does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/event');
			}
						
			//set values to db values
			$data['id']				= $event['id'];	
			$data['date']			= date('d-m-Y', strtotime($event['date']));
			$data['date_to']			= date('d-m-Y', strtotime($event['date_to']));
			$data['time']			= $event['time'];
			$data['time_to']			= $event['time_to'];
			$data['event']			= $event['event'];
			$data['venue']			= $event['venue'];			
			$data['brands']			= $event['brands'];
			$data['status']			= $event['status'];
		}
		
		
		
		$this->form_validation->set_rules('date', 'lang:date', 'trim|required');
		$this->form_validation->set_rules('date_to', 'lang:date_to', 'trim');
		$this->form_validation->set_rules('time', 'lang:time', 'trim|required');
		$this->form_validation->set_rules('time_to', 'lang:time_to', 'trim|required');
		$this->form_validation->set_rules('event', 'lang:event', 'trim|required');
		$this->form_validation->set_rules('venue', 'lang:venue', 'trim|required');
		$this->form_validation->set_rules('brands', 'lang:brands', 'trim');
		$this->form_validation->set_rules('status', 'lang:status', 'trim');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/event_form', $data);
		}
		else
		{
			$this->load->helper('text');
			
			$uploaded	= $this->upload->do_upload('image');
			
			$save = array();
						
			$save['date']		= date('Y-m-d', strtotime($this->input->post('date')));		
			$save['date_to']	= date('Y-m-d', strtotime($this->input->post('date_to')));
			$save['time']		= $this->input->post('time');
			$save['time_to']	= $this->input->post('time_to');
			
			$save['event']		= $this->input->post('event');									
			$save['venue']		= $this->input->post('venue');
			$save['brands']		= $this->input->post('brands');
			$save['status']		= $this->input->post('status');
			
			$save['id']			= $id;								
			
			//save the event
			$event_id	= $this->event_model->save_event($save);
									
			$this->session->set_flashdata('message', lang('message_saved_event'));
			
			//go back to the event list
			redirect($this->config->item('admin_folder').'/event');
		}
	}
	


}	