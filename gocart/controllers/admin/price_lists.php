<?php
class Price_Lists extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);
		$this->load->model('price_lists_model');
		$this->lang->load('price_lists');								
	}
		
	function index()
	{
		$data['price_lists_title']	= lang('price_lists');
		$data['price_lists']		= $this->price_lists_model->get_list();								
		
		$this->view($this->config->item('admin_folder').'/price_lists', $data);
	}
	
	/********************************************************************
	edit price_lists
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
		$data['url_link']	= '';
		
		
		$data['price_lists_title']	= lang('price_lists_form');
		$data['price_lists']		= $this->price_lists_model->get_list();
		
		if($id)
		{
			
			$price_lists			= $this->price_lists_model->get_price($id);
			
			if(!$price_lists)
			{
				//price_lists does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/price_lists');
			}
						
			//set values to db values
			$data['id']				= $price_lists['id'];			
			$data['title']			= $price_lists['title'];
			$data['caption']		= $price_lists['caption'];
			$data['content']		= $price_lists['content'];
			$data['sequence']		= $price_lists['sequence'];
			$data['seo_title']		= $price_lists['seo_title'];
			$data['meta']			= $price_lists['meta'];
			$data['enable_date']	= $price_lists['enable_date'];
			$data['disable_date']	= $price_lists['disable_date'];
			$data['image']			= $price_lists['image'];
			$data['status']			= $price_lists['status'];
			$data['url_link']		= $price_lists['url_link'];
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
		$this->form_validation->set_rules('url_link', 'lang:url_link', 'trim');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/price_lists_form', $data);
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
			$save['url_link']	= $this->input->post('url_link');				
				
								
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
					$this->view(config_item('admin_folder').'/price_lists_form', $data);
					return; //end script here if there is an error
				}
			}
				
			if($uploaded)
			{
				$image			= $this->upload->data();
				$save['image']	= $image['file_name'];
			}
			
			
			
			//save the price_lists
			$price_lists_id	= $this->price_lists_model->save_price($save);
									
			$this->session->set_flashdata('message', lang('message_saved_price_lists'));
			
			//go back to the price_lists list
			redirect($this->config->item('admin_folder').'/price_lists');
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

		
		$data['price_lists_title']	= lang('link_form');
		$data['price_lists']		= $this->price_lists_model->get_list();
		if($id)
		{
			$price_lists			= $this->price_lists_model->get_price($id);

			if(!$price_lists)
			{
				//price_lists does not exist
				$this->session->set_flashdata('error', lang('error_link_not_found'));
				redirect($this->config->item('admin_folder').'/price_lists');
			}
			
			
			//set values to db values
			$data['id']			= $price_lists->id;
			$data['parent_id']	= $price_lists->parent_id;
			$data['title']		= $price_lists->title;
			$data['url']		= $price_lists->url;
			$data['new_window']	= (bool)$price_lists->new_window;
			$data['sequence']	= $price_lists->sequence;
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
			
			//save the price_lists
			$this->price_lists_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_link'));
			
			//go back to the price_lists list
			redirect($this->config->item('admin_folder').'/price_lists');
		}
	}
	
	/********************************************************************
	delete price_lists
	********************************************************************/
	function delete($id)
	{
		
		$price_lists	= $this->price_lists_model->get_price($id);
		
		if($price_lists)
		{
			$this->price_lists_model->delete_price($id);
			$this->session->set_flashdata('message', lang('message_deleted_price_lists'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/price_lists');
	}
}	