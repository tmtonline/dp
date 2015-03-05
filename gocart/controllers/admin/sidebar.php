<?php
class Sidebar extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);
		$this->load->model('Sidebar_Model');
		$this->lang->load('sidebar');								
	}
		
	function index()
	{
		$data['sidebar_title']	= lang('sidebar');
		$data['sidebars']		= $this->Sidebar_Model->get_list();								
		
		$this->view($this->config->item('admin_folder').'/sidebars', $data);
	}
	
	/********************************************************************
	edit sidebar
	********************************************************************/
	function form($id = false)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//set the default values
		$data['id']				= '';
		$data['title']			= '';
		$data['left_content']	= '';
		$data['right_content']	= '';
		$data['sequence']	= 0;
		$data['seo_title']	= '';
		$data['meta']		= '';		
		$data['url']		= '';		
		
		$data['sidebar_title']	= lang('sidebar_form');
		$data['sidebar']		= $this->Sidebar_Model->get_list();
		
		if($id)
		{			
			$sidebar			= $this->Sidebar_Model->get_content($id);
			
			if(!$sidebar)
			{
				//sidebar does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/sidebar');
			}
						
			//set values to db values
			$data['id']				= $sidebar['id'];			
			$data['title']			= $sidebar['title'];
			$data['left_content']	= $sidebar['left_content'];
			$data['right_content']	= $sidebar['right_content'];
			$data['sequence']		= $sidebar['sequence'];
			$data['seo_title']		= $sidebar['seo_title'];
			$data['meta']			= $sidebar['meta'];
			$data['url']			= $sidebar['url'];			
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('left_content', 'lang:left_content', 'trim');
		$this->form_validation->set_rules('right_content', 'lang:right_content', 'trim');		
		$this->form_validation->set_rules('url', 'lang:url', 'trim');
		$this->form_validation->set_rules('seo_title', 'lang:seo_title', 'trim');
		$this->form_validation->set_rules('meta', 'lang:meta', 'trim');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');						
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/sidebar_form', $data);
		}
		else
		{
			$this->load->helper('text');
			
			$save = array();
			$save['id']			= $id;
			$save['title']		= $this->input->post('title');
			$save['sequence']	= $this->input->post('sequence');
			$save['left_content']	= $this->input->post('left_content');						
			$save['right_content']	= $this->input->post('right_content');
					
			$save['seo_title']	= $this->input->post('seo_title');
			$save['meta']		= $this->input->post('meta');
								
			
			//save the sidebar
			$sidebar_id	= $this->Sidebar_Model->save_content($save);
									
			$this->session->set_flashdata('message', lang('message_saved_sidebar'));
			
			//go back to the sidebar list
			redirect($this->config->item('admin_folder').'/sidebar');
		}
	}
	
	function link_form($id = false)
	{
	
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//set the default values
		$data['id']			= '';
		$data['title']		= '';
		$data['url']		= '';
		$data['sequence']	= 0;
		

		
		$data['sidebar_title']	= lang('link_form');
		$data['sidebar']		= $this->Sidebar_Model->get_list();
		if($id)
		{
			$sidebar			= $this->Sidebar_Model->get_content($id);

			if(!$sidebar)
			{
				//sidebar does not exist
				$this->session->set_flashdata('error', lang('error_link_not_found'));
				redirect($this->config->item('admin_folder').'/sidebar');
			}
			
			
			//set values to db values
			$data['id']			= $sidebar->id;
			$data['parent_id']	= $sidebar->parent_id;
			$data['title']		= $sidebar->title;
			$data['url']		= $sidebar->url;
			$data['new_window']	= (bool)$sidebar->new_window;
			$data['sequence']	= $sidebar->sequence;
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('url', 'lang:url', 'trim|required');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('new_window', 'lang:new_window', 'trim|integer');
		$this->form_validation->set_rules('parent_id', 'lang:parent_id', 'trim|integer');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/link_form', $data);
		}
		else
		{	
			$save = array();
			$save['id']			= $id;
			$save['parent_id']	= $this->input->post('parent_id');
			$save['title']		= $this->input->post('title');
			$save['menu_title']	= $this->input->post('title'); 
			$save['url']		= $this->input->post('url');
			$save['sequence']	= $this->input->post('sequence');
			$save['new_window']	= $this->input->post('new_window');
			
			//save the sidebar
			$this->Sidebar_Model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_link'));
			
			//go back to the sidebar list
			redirect($this->config->item('admin_folder').'/sidebar');
		}
	}
	
	/********************************************************************
	delete sidebar
	********************************************************************/
	function delete($id)
	{
		
		$sidebar	= $this->Sidebar_Model->get_sidebar($id);
		
		if($sidebar)
		{
			$this->Sidebar_Model->delete_sidebar($id);
			$this->session->set_flashdata('message', lang('message_deleted_sidebar'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/sidebar');
	}
}	