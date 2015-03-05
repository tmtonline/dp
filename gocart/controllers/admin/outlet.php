<?php
class Outlet extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);
		$this->load->model('outlet_model');
		$this->lang->load('outlet');	
		$this->load->helper('form');
	}
		
	function index($order_by="id", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		$data['outlet_title']	= lang('outlet');
		/* $data['outlets']		= $this->outlet_model->get_list(); */	
		$data['code']		= $code;
		$term				= false;
		
		$post				= $this->input->post(null, false);
		$this->load->model('Search_model');
		if($post)
		{
			$term			= json_encode($post);
			$code			= $this->Search_model->record_term($term);
			$data['code']	= $code;
		}
		elseif ($code)
		{
			$term			= $this->Search_model->get_term($code);
		}

		$data['term']		= $term;
		$data['order_by']	= $order_by;
		$data['sort_order']	= $sort_order;
		$data['state']			= $this->Location_model->get_zones('129');
		
		
		
		
		$data['outlets']	= $this->outlet_model->outlets(array('term'=>$term, 'order_by'=>$order_by, 'sort_order'=>$sort_order, 'rows'=>$rows, 'page'=>$page));		
		//total number of products
		$data['total']		= $this->outlet_model->outlets(array('term'=>$term, 'order_by'=>$order_by, 'sort_order'=>$sort_order), true);
		
		$this->load->library('pagination');
		
		$config['base_url']			= site_url($this->config->item('admin_folder').'/outlet/index/'.$order_by.'/'.$sort_order.'/'.$code.'/');
		$config['total_rows']		= $data['total'];
		$config['per_page']			= $rows;
		$config['uri_segment']		= 7;
		$config['first_link']		= 'First';
		$config['first_tag_open']	= '<li>';
		$config['first_tag_close']	= '</li>';
		$config['last_link']		= 'Last';
		$config['last_tag_open']	= '<li>';
		$config['last_tag_close']	= '</li>';
		
		$config['full_tag_open']	= '<div class="pagination"><ul>';
		$config['full_tag_close']	= '</ul></div>';
		$config['cur_tag_open']		= '<li class="active"><a href="#">';
		$config['cur_tag_close']	= '</a></li>';
		
		$config['num_tag_open']		= '<li>';
		$config['num_tag_close']	= '</li>';
		
		$config['prev_link']		= '&laquo;';
		$config['prev_tag_open']	= '<li>';
		$config['prev_tag_close']	= '</li>';
		
		$config['next_link']		= '&raquo;';
		$config['next_tag_open']	= '<li>';
		$config['next_tag_close']	= '</li>';
		
		$this->pagination->initialize($config);
		
		$this->view($this->config->item('admin_folder').'/outlet', $data);
	}
	
	function bulk_save()
	{
		$outlet	= $this->input->post('outlet');
	
		if(!$outlet)
		{
			$this->session->set_flashdata('error',  lang('error_bulk_no_products'));
			redirect($this->config->item('admin_folder').'/outlet');
		}
	
		foreach($outlet as $id=>$outlet)
		{
			$outlet['id']	= $id;
			$this->outlet_model->save_outlet($outlet);
		}
	
		$this->session->set_flashdata('message', lang('message_bulk_update'));
		redirect($this->config->item('admin_folder').'/outlet');
	}
	
	/********************************************************************
	edit outlet
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
		$data['zone_id']	= '';
		$data['outlet']		= '';
		$data['address']	= '';
		$data['contact']	= '';
		$data['status']		= '';		
		$data['outlet_title']	= lang('outlet_form');
		//$data['outlet']			= $this->outlet_model->get_outlet($id);
		$data['state']			= $this->Location_model->get_zones('129');
		
		if($id)
		{
			
			$outlet			= $this->outlet_model->get_outlet($id);
			
			if(!$outlet)
			{
				//outlet does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/outlet');
			}
						
			//set values to db values
			$data['id']				= $outlet['id'];	
			$data['zone_id']		= $outlet['zone_id'];
			$data['outlet']			= $outlet['outlet'];
			$data['address']		= $outlet['address'];
			$data['contact']		= $outlet['contact'];			
			$data['status']			= $outlet['status'];
		}
		
		$this->form_validation->set_rules('zone_id', 'lang:state', 'trim|required');
		$this->form_validation->set_rules('outlet', 'lang:outlet', 'trim|required');
		$this->form_validation->set_rules('address', 'lang:address', 'trim|required');
		$this->form_validation->set_rules('contact', 'lang:contact', 'trim');
		$this->form_validation->set_rules('status', 'lang:status', 'trim');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/outlet_form', $data);
		}
		else
		{
			$this->load->helper('text');
			
			$uploaded	= $this->upload->do_upload('image');
			
			$save = array();
						
			$save['zone_id']	= $this->input->post('zone_id');
			$save['outlet']		= $this->input->post('outlet');
			$save['address']	= $this->input->post('address');
			$save['contact']	= $this->input->post('contact');									
			$save['status']		= $this->input->post('status');
					
			$save['id']			= $id;								

			
			//save the outlet
			$outlet_id	= $this->outlet_model->save_outlet($save);
									
			$this->session->set_flashdata('message', lang('message_saved_outlet'));
			
			//go back to the outlet list
			redirect($this->config->item('admin_folder').'/outlet');
		}
	}
	
	function link_form($id = false)
	{
	
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//set the default values
		$data['id']			= '';
		$data['outlet']		= '';
		$data['address']		= '';
		$data['contact']		= '';
		
		$data['outlet_title']	= lang('link_form');
		$data['outlet']		= $this->outlet_model->get_list();
		if($id)
		{
			$outlet			= $this->outlet_model->get_outlet($id);

			if(!$outlet)
			{
				//outlet does not exist
				$this->session->set_flashdata('error', lang('error_link_not_found'));
				redirect($this->config->item('admin_folder').'/outlet');
			}
						
			//set values to db values
			$data['id']			= $outlet->id;
			$data['address']	= $outlet->address;
			$data['contact']	= $outlet->contact;
			$data['status']		= $outlet->status;				
			
		}
		
		$this->form_validation->set_rules('outlet', 'lang:outlet', 'trim|required');
		$this->form_validation->set_rules('address', 'lang:address', 'trim|required');
		$this->form_validation->set_rules('contact', 'lang:contact', 'trim|integer');
		$this->form_validation->set_rules('status', 'lang:status', 'trim|integer');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/link_form', $data);
		}
		else
		{	
			$save = array();
			$save['id']			= $id;
			$save['outlet']		= $this->input->post('outlet');
			$save['address']	= $this->input->post('address'); 
			$save['contact']	= $this->input->post('contact');
			$save['status']		= $this->input->post('status');
			
			//save the outlet
			$this->outlet_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_link'));
			
			//go back to the outlet list
			redirect($this->config->item('admin_folder').'/outlet');
		}
	}
	
	/********************************************************************
	delete outlet
	********************************************************************/
	function delete($id)
	{
		
		$outlet	= $this->outlet_model->get_outlet($id);
		
		if($outlet)
		{
			$this->outlet_model->delete_outlet($id);
			$this->session->set_flashdata('message', lang('message_deleted_outlet'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/outlet');
	}
}	