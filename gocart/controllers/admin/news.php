<?php
class News extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);
		$this->load->model('New_model');
		$this->lang->load('new');
	}
		
	function index()
	{
		$data['new_title']	= lang('news');
		$data['news']		= $this->New_model->get_news();
		
		
		$this->view($this->config->item('admin_folder').'/news', $data);
	}
	
	/********************************************************************
	edit new
	********************************************************************/
	function form($id = false)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//set the default values
		$data['id']			= '';
		$data['title']		= '';
		$data['menu_title']	= '';
		$data['slug']		= '';
		$data['sequence']	= 0;
		$data['content']	= '';
		$data['seo_title']	= '';
		$data['meta']		= '';
		
		$data['new_title']	= lang('new_form');
		$data['news']		= $this->New_model->get_news();
		
		if($id)
		{
			
			$new			= $this->New_model->get_new($id);

			if(!$new)
			{
				//new does not exist
				$this->session->set_flashdata('error', lang('error_new_not_found'));
				redirect($this->config->item('admin_folder').'/news');
			}
			
			
			//set values to db values
			$data['id']				= $new->id;
			$data['title']			= $new->title;
			$data['menu_title']		= $new->menu_title;
			$data['sequence']		= $new->sequence;
			$data['content']		= $new->content;
			$data['seo_title']		= $new->seo_title;
			$data['meta']			= $new->meta;
			$data['slug']			= $new->slug;
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('menu_title', 'lang:menu_title', 'trim');
		$this->form_validation->set_rules('slug', 'lang:slug', 'trim');
		$this->form_validation->set_rules('seo_title', 'lang:seo_title', 'trim');
		$this->form_validation->set_rules('meta', 'lang:meta', 'trim');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('content', 'lang:content', 'trim');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/new_form', $data);
		}
		else
		{
			$this->load->helper('text');
			
			//first check the slug field
			$slug = $this->input->post('slug');
			
			//if it's empty assign the name field
			if(empty($slug) || $slug=='')
			{
				$slug = $this->input->post('title');
			}
			
			$slug	= url_title(convert_accented_characters($slug), 'dash', TRUE);
			
			//validate the slug
			$this->load->model('Routes_model');
			if($id)
			{
				$slug		= $this->Routes_model->validate_slug($slug, $new->route_id);
				$route_id	= $new->route_id;
			}
			else
			{
				$slug			= $this->Routes_model->validate_slug($slug);
				$route['slug']	= $slug;	
				$route_id		= $this->Routes_model->save($route);
			}
			
			
			$save = array();
			$save['id']			= $id;
			$save['title']		= $this->input->post('title');
			$save['menu_title']	= $this->input->post('menu_title'); 
			$save['sequence']	= $this->input->post('sequence');
			$save['content']	= $this->input->post('content');
			$save['seo_title']	= $this->input->post('seo_title');
			$save['meta']		= $this->input->post('meta');
			$save['route_id']	= $route_id;
			$save['slug']		= $slug;
			
			//set the menu title to the new title if if is empty
			if ($save['menu_title'] == '')
			{
				$save['menu_title']	= $this->input->post('title');
			}
			
			//save the new
			$new_id	= $this->New_model->save($save);
			
			//save the route
			$route['id']	= $route_id;
			$route['slug']	= $slug;
			$route['route']	= 'cart/new/'.$new_id;
			
			$this->Routes_model->save($route);
			
			$this->session->set_flashdata('message', lang('message_saved_new'));
			
			//go back to the new list
			redirect($this->config->item('admin_folder').'/news');
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

		
		$data['new_title']	= lang('link_form');
		$data['news']		= $this->New_model->get_news();
		if($id)
		{
			$new			= $this->New_model->get_new($id);

			if(!$new)
			{
				//new does not exist
				$this->session->set_flashdata('error', lang('error_link_not_found'));
				redirect($this->config->item('admin_folder').'/news');
			}
			
			
			//set values to db values
			$data['id']			= $new->id;
			$data['title']		= $new->title;
			$data['url']		= $new->url;
			$data['new_window']	= (bool)$new->new_window;
			$data['sequence']	= $new->sequence;
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('url', 'lang:url', 'trim|required');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('new_window', 'lang:new_window', 'trim|integer');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/link_form', $data);
		}
		else
		{	
			$save = array();
			$save['id']			= $id;
			$save['title']		= $this->input->post('title');
			$save['menu_title']	= $this->input->post('title'); 
			$save['url']		= $this->input->post('url');
			$save['sequence']	= $this->input->post('sequence');
			$save['new_window']	= $this->input->post('new_window');
			
			//save the new
			$this->New_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_link'));
			
			//go back to the new list
			redirect($this->config->item('admin_folder').'/news');
		}
	}
	
	/********************************************************************
	delete new
	********************************************************************/
	function delete($id)
	{
		
		$new	= $this->New_model->get_new($id);
		
		if($new)
		{
			$this->load->model('Routes_model');
			
			$this->Routes_model->delete($new->route_id);
			$this->New_model->delete_new($id);
			$this->session->set_flashdata('message', lang('message_deleted_new'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_new_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/news');
	}
}	