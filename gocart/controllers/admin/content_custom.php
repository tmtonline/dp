<?php
class Content_Custom extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);
		$this->load->model('content_custom_model');
		$this->lang->load('content_custom');								
	}
		
	function index()
	{
		$data['content_custom_title']	= lang('content_custom');
		$data['content_customs']		= $this->content_custom_model->get_list();								
		
		$this->view($this->config->item('admin_folder').'/content_custom', $data);
	}
	
	/********************************************************************
	edit content_custom
	********************************************************************/
	function form($id = false)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//set the default values
		$data['id']			= '';
		$data['title']		= '';
		$data['caption']	= '';
		$data['content']	= '';
		$data['caption_color']	= '';		
		$data['sequence']	= 0;
		$data['seo_title']	= '';
		$data['meta']		= '';		
		$data['url']		= '';		
		$data['enable_date']		= '';
		$data['disable_date']		= '';
		$data['image']		= '';
		$data['new_window']		= '';
		
		$data['content_custom_title']	= lang('content_custom_form');
		$data['content_custom']		= $this->content_custom_model->get_list();
		
		if($id)
		{
			
			$content_custom			= $this->content_custom_model->get_content($id);
			
			if(!$content_custom)
			{
				//content_custom does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/content_custom');
			}
						
			//set values to db values
			$data['id']				= $content_custom['id'];			
			$data['title']			= $content_custom['title'];
			$data['caption']		= $content_custom['caption'];
			$data['content']		= $content_custom['content'];
			$data['caption_color']	= $content_custom['caption_color'];
			$data['sequence']		= $content_custom['sequence'];
			$data['seo_title']		= $content_custom['seo_title'];
			$data['meta']			= $content_custom['meta'];
			$data['url']			= $content_custom['url'];
			$data['enable_date']	= $content_custom['enable_date'];
			$data['disable_date']	= $content_custom['disable_date'];
			$data['image']			= $content_custom['image'];
			$data['new_window']		= $content_custom['new_window'];
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('caption', 'lang:caption', 'trim');
		$this->form_validation->set_rules('content', 'lang:content', 'trim');
		$this->form_validation->set_rules('caption_color', 'lang:caption_color', 'trim');
		$this->form_validation->set_rules('url', 'lang:url', 'trim');
		$this->form_validation->set_rules('enable_date', 'lang:enable_date', 'trim');
		$this->form_validation->set_rules('disable_date', 'lang:disable_date', 'trim');
		$this->form_validation->set_rules('image', 'lang:image', 'trim');
		$this->form_validation->set_rules('new_window', 'lang:new_window', 'trim');						
		$this->form_validation->set_rules('seo_title', 'lang:seo_title', 'trim');
		$this->form_validation->set_rules('meta', 'lang:meta', 'trim');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
						
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/content_custom_form', $data);
		}
		else
		{
			$this->load->helper('text');
			
			$save = array();
			$save['id']			= $id;
			$save['title']		= $this->input->post('title');
			$save['sequence']	= $this->input->post('sequence');
			$save['content']	= $this->input->post('content');						
			
			$save['seo_title']	= $this->input->post('seo_title');
			$save['meta']		= $this->input->post('meta');
								
			
			//save the content_custom
			$content_custom_id	= $this->content_custom_model->save_content($save);
									
			$this->session->set_flashdata('message', lang('message_saved_content_custom'));
			
			//go back to the content_custom list
			redirect($this->config->item('admin_folder').'/content_custom');
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
		$data['new_window']	= false;
		$data['sequence']	= 0;
		$data['parent_id']	= 0;

		
		$data['content_custom_title']	= lang('link_form');
		$data['content_custom']		= $this->content_custom_model->get_list();
		if($id)
		{
			$content_custom			= $this->content_custom_model->get_content($id);

			if(!$content_custom)
			{
				//content_custom does not exist
				$this->session->set_flashdata('error', lang('error_link_not_found'));
				redirect($this->config->item('admin_folder').'/content_custom');
			}
			
			
			//set values to db values
			$data['id']			= $content_custom->id;
			$data['parent_id']	= $content_custom->parent_id;
			$data['title']		= $content_custom->title;
			$data['url']		= $content_custom->url;
			$data['new_window']	= (bool)$content_custom->new_window;
			$data['sequence']	= $content_custom->sequence;
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
			
			//save the content_custom
			$this->content_custom_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_link'));
			
			//go back to the content_custom list
			redirect($this->config->item('admin_folder').'/content_custom');
		}
	}
	
	/********************************************************************
	delete content_custom
	********************************************************************/
	function delete($id)
	{
		
		$content_custom	= $this->content_custom_model->get_content_custom($id);
		
		if($content_custom)
		{
			$this->load->model('Routes_model');
			
			$this->Routes_model->delete($content_custom->route_id);
			$this->content_custom_model->delete_content_custom($id);
			$this->session->set_flashdata('message', lang('message_deleted_content_custom'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/content_custom');
	}
}	