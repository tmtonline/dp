<?php
class Galleries extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);
		$this->load->model('gallery_model');
		$this->lang->load('gallery');								
	}
		
	function index()
	{
		$data['gallery_title']	= lang('gallery');
		$data['galleries']		= $this->gallery_model->get_list();								
		
		$this->view($this->config->item('admin_folder').'/galleries', $data);
	}
	
	/********************************************************************
	edit gallery
	********************************************************************/
	function form($id = false)
	{
		$this->load->helper('url');
		$this->load->helper('form');
						
		$config['upload_path'] 		= 'uploads/gallery/full';
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
		
		$data['gallery_title']	= lang('gallery_form');
		$data['galleries']		= $this->gallery_model->get_list();
		
		if($id)
		{
			
			$gallery			= $this->gallery_model->get_gallery($id);
			
			if(!$gallery)
			{
				//gallery does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/galleries');
			}
						
			//set values to db values
			$data['id']				= $gallery['id'];			
			$data['title']			= $gallery['title'];
			$data['caption']		= $gallery['caption'];
			$data['content']		= $gallery['content'];
			$data['sequence']		= $gallery['sequence'];
			$data['seo_title']		= $gallery['seo_title'];
			$data['meta']			= $gallery['meta'];
			$data['enable_date']	= $gallery['enable_date'];
			$data['disable_date']	= $gallery['disable_date'];
			$data['image']			= $gallery['image'];
			$data['status']			= $gallery['status'];
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
			$this->view($this->config->item('admin_folder').'/gallery_form', $data);
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
					$this->view(config_item('admin_folder').'/gallery_form', $data);
					return; //end script here if there is an error
				}
			}
				
			if($uploaded)
			{
				$image			= $this->upload->data();
									
				$this->load->library('image_lib');
				/*
				 	
				I find that ImageMagick is more efficient that GD2 but not everyone has it
				if your server has ImageMagick then you can change out the line
					
				$config['image_library'] = 'gd2';
					
				with
					
				$config['library_path']		= '/usr/bin/convert'; //make sure you use the correct path to ImageMagic
				$config['image_library']	= 'ImageMagick';
				*/
					
				//this is the larger image
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/gallery/full/'.$image['file_name'];
				$config['new_image']	= 'uploads/gallery/medium/'.$image['file_name'];
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 600;
				$config['height'] = 500;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				
				//small image
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/gallery/medium/'.$image['file_name'];
				$config['new_image']	= 'uploads/gallery/small/'.$image['file_name'];
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 235;
				$config['height'] = 235;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				
				//cropped thumbnail
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/gallery/small/'.$image['file_name'];
				$config['new_image']	= 'uploads/gallery/thumbnails/'.$image['file_name'];
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 150;
				$config['height'] = 150;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				
				$save['image']	= $image['file_name'];
		
			}
			
			//save the gallery
			$gallery_id	= $this->gallery_model->save_gallery($save);
									
			$this->session->set_flashdata('message', lang('message_saved_gallery'));
			
			//go back to the gallery list
			redirect($this->config->item('admin_folder').'/galleries');
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

		
		$data['gallery_title']	= lang('link_form');
		$data['galleries']		= $this->gallery_model->get_list();
		if($id)
		{
			$gallery			= $this->gallery_model->get_gallery($id);

			if(!$gallery)
			{
				//gallery does not exist
				$this->session->set_flashdata('error', lang('error_link_not_found'));
				redirect($this->config->item('admin_folder').'/galleries');
			}
			
			
			//set values to db values
			$data['id']			= $gallery->id;
			$data['parent_id']	= $gallery->parent_id;
			$data['title']		= $gallery->title;
			$data['url']		= $gallery->url;
			$data['new_window']	= (bool)$gallery->new_window;
			$data['sequence']	= $gallery->sequence;
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
			
			//save the gallery
			$this->gallery_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_link'));
			
			//go back to the gallery list
			redirect($this->config->item('admin_folder').'/galleries');
		}
	}
	
	/********************************************************************
	delete gallery
	********************************************************************/
	function delete($id)
	{
		
		$gallery	= $this->gallery_model->get_gallery($id);
		
		if($gallery)
		{
			$this->gallery_model->delete_gallery($id);
			$this->session->set_flashdata('message', lang('message_deleted_gallery'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/galleries');
	}
}	