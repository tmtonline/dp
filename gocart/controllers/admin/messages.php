<?php
class Messages extends Admin_Controller
{
	//these are used when editing, adding or deleting an admin
	var $admin_id		= false;
	var $current_admin	= false;
	function __construct()
	{
		parent::__construct();
		$this->auth->check_access('Admin', true);
		
		$this->load->model('Message_model');		
		//load the admin language file in
		$this->lang->load('message');						
	}

	function index()
	{
		$data['page_title']	= lang('messages');
		$data['messages']	= $this->Message_model->get_messages();

		$this->view($this->config->item('admin_folder').'/messages', $data);
	}
	function delete($id)
	{
		
		//delete the user
		$this->Message_model->delete($id);
		$this->session->set_flashdata('message', lang('message_deleted'));
		redirect($this->config->item('admin_folder').'/messages');
	}
	function form($id = false)
	{	
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$data['page_title']		= lang('message_form');
		
		//default values are empty if the customer is new
		$data['id']		= '';
		$data['name']	= '';
		$data['email_address']		= '';		
		$data['telephone_number']		= '';
		$data['fascimile_number']		= '';		
		$data['address']		= '';
		$data['city']			= '';
		$data['state']			= '';		
		$data['postcode']		= '';
						
		if ($id)
		{	
			$message			= $this->Message_model->get_message($id);
			//set values to db values
			$data['id']					= $message->id;
			$data['name']				= $message->name;						
			$data['email_address']		= $message->email_address;
			$data['company_name']		= $message->company_name;							
			$data['telephone_number']	= $message->telephone_number;
			$data['facsimile_number']	= $message->facsimile_number;			
			$data['address']			= $message->address;
			$data['city']				= $message->city;
			$data['state']				= $message->state;
			$data['postcode']			= $message->postcode;				
			$data['country']			= $this->Location_model->get_country($message->country_id);						
			$data['comment']			= $message->comment;
			
		}
		
		$this->form_validation->set_rules('name', 'lang:name', 'trim|max_length[32]');
		$this->form_validation->set_rules('email_address', 'lang:email_address', 'trim|required|valid_email|max_length[128]');
		// this only for display purpuse, no need to validate to wasting time here.		
						
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/message_form', $data);
		}
		else
		{
			$save['id']					= $id;
			$save['name']				= $this->input->post('name');
			$save['email_address']		= $this->input->post('email_address');
									
			$this->Message_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_user_saved'));			
			//go back to the customer list
			redirect($this->config->item('admin_folder').'/messages');
		}
	}
	

}