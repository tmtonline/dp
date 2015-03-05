<?php
class Memberships extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);
		$this->load->model('memberships_model');
		$this->lang->load('memberships');								
	}
		
	function index()
	{
		$data['memberships_title']	= lang('memberships');
		$data['memberships']		= $this->memberships_model->get_list();								
		
		$this->view($this->config->item('admin_folder').'/memberships', $data);
	}
	
	/********************************************************************
	edit memberships
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
		$data['title']		= '';
		$data['caption']	= '';
		$data['content']	= '';
		$data['sequence']	= 0;
		$data['seo_title']	= '';
		$data['meta']		= '';		
		$data['enable_date']		= '';
		$data['disable_date']		= '';
		$data['image']		= '';
		$data['status']		= '';
		
		$data['memberships_title']	= lang('memberships_form');
		$data['memberships']		= $this->memberships_model->get_list();
		
		if($id)
		{
			
			$memberships			= $this->memberships_model->get_memberships($id);
			
			if(!$memberships)
			{
				//memberships does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/memberships');
			}
						
			//set values to db values
			$data['id']				= $memberships['id'];			
			$data['title']			= $memberships['title'];
			$data['caption']		= $memberships['caption'];
			$data['content']		= $memberships['content'];
			$data['sequence']		= $memberships['sequence'];
			$data['seo_title']		= $memberships['seo_title'];
			$data['meta']			= $memberships['meta'];
			$data['enable_date']	= $memberships['enable_date'];
			$data['disable_date']	= $memberships['disable_date'];
			$data['image']			= $memberships['image'];
			$data['status']			= $memberships['status'];
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('caption', 'lang:caption', 'trim');
		$this->form_validation->set_rules('content', 'lang:content', 'trim');
		$this->form_validation->set_rules('enable_date', 'lang:enable_date', 'trim');
		$this->form_validation->set_rules('disable_date', 'lang:disable_date', 'trim');
		$this->form_validation->set_rules('image', 'lang:image', 'trim');
		$this->form_validation->set_rules('seo_title', 'lang:seo_title', 'trim');
		$this->form_validation->set_rules('meta', 'lang:meta', 'trim');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('status', 'lang:status', 'trim');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/memberships_form', $data);
		}
		else
		{
			$this->load->helper('text');
			
			$uploaded	= $this->upload->do_upload('image');
			
			$save = array();
			
			$save['title']		= $this->input->post('title');
			$save['sequence']	= $this->input->post('sequence');
			$save['content']	= $this->input->post('content');						
			
			$save['seo_title']	= $this->input->post('seo_title');
			$save['meta']		= $this->input->post('meta');
			$save['status']		= $this->input->post('status');
				
								
			if ($id)
			{
				$save['id']			= $id;
			
				//delete the original file if another is uploaded
				if($uploaded)
				{
					if($data['image'] != '')
					{
						$file = 'uploads/'.$data['image'];
			
						//delete the existing file if needed
						if(file_exists($file))
						{
							unlink($file);
						}
					}
				}
			
			}
			else
			{
				if(!$uploaded)
				{
					$data['error']	= $this->upload->display_errors();
					$this->view(config_item('admin_folder').'/memberships_form', $data);
					return; //end script here if there is an error
				}
			}
				
			if($uploaded)
			{
				$image			= $this->upload->data();
				$save['image']	= $image['file_name'];
			}
			
			
			
			//save the memberships
			$memberships_id	= $this->memberships_model->save_memberships($save);
									
			$this->session->set_flashdata('message', lang('message_saved_memberships'));
			
			//go back to the memberships list
			redirect($this->config->item('admin_folder').'/memberships');
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

		
		$data['memberships_title']	= lang('link_form');
		$data['memberships']		= $this->memberships_model->get_list();
		if($id)
		{
			$memberships			= $this->memberships_model->get_memberships($id);

			if(!$memberships)
			{
				//memberships does not exist
				$this->session->set_flashdata('error', lang('error_link_not_found'));
				redirect($this->config->item('admin_folder').'/memberships');
			}
			
			
			//set values to db values
			$data['id']			= $memberships->id;
			$data['parent_id']	= $memberships->parent_id;
			$data['title']		= $memberships->title;
			$data['url']		= $memberships->url;
			$data['new_window']	= (bool)$memberships->new_window;
			$data['sequence']	= $memberships->sequence;
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
			
			//save the memberships
			$this->memberships_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_link'));
			
			//go back to the memberships list
			redirect($this->config->item('admin_folder').'/memberships');
		}
	}
	
	/********************************************************************
	delete memberships
	********************************************************************/
	function delete($id)
	{
		
		$memberships	= $this->memberships_model->get_memberships($id);
		
		if($memberships)
		{
			$this->memberships_model->delete_memberships($id);
			$this->session->set_flashdata('message', lang('message_deleted_memberships'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/memberships');
	}
}	