<?php
class Event extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);
		$this->load->model('event_model');
		$this->lang->load('event');	
		$this->load->helper('form');
	}
		
	function index($order_by="id", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		$data['event_title']	= lang('event');
		/* $data['event']		= $this->event_model->get_list(); */	
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
		$data['state']		= $this->Location_model->get_zones('129');
		
		
		$data['event']	= $this->event_model->event(array('term'=>$term, 'order_by'=>$order_by, 'sort_order'=>$sort_order, 'rows'=>$rows, 'page'=>$page));		
		//total number of products
		$data['total']		= $this->event_model->event(array('term'=>$term, 'order_by'=>$order_by, 'sort_order'=>$sort_order), true);
		
		$this->load->library('pagination');
		
		$config['base_url']			= site_url($this->config->item('admin_folder').'/event/index/'.$order_by.'/'.$sort_order.'/'.$code.'/');
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
		
		$this->view($this->config->item('admin_folder').'/event', $data);
	}
	
	function bulk_save()
	{
		$event	= $this->input->post('event');
	
		if(!$event)
		{
			$this->session->set_flashdata('error',  lang('error_bulk_no_products'));
			redirect($this->config->item('admin_folder').'/event');
		}

		foreach($event as $id=>$event)
		{
			$event['id']	= $id;
									
			$this->event_model->save_event($event);
		}
	
		$this->session->set_flashdata('message', lang('message_bulk_update'));
		redirect($this->config->item('admin_folder').'/event');
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
	
	function link_form($id = false)
	{
	
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');		
		$this->load->library('form_validation');
		
		//set the default values
		$data['id']			= '';
		$data['date']		= '';
		$data['date_to']	= '';
		$data['time']		= '';
		$data['time_to']	= '';
		$data['event']		= '';
		$data['venue']		= '';
		$data['brands']		= '';
		$data['status']		= '';
		
		$data['event_title']	= lang('link_form');
		$data['event']		= $this->event_model->get_list();
		if($id)
		{
			$event			= $this->event_model->get_event($id);

			if(!$event)
			{
				//event does not exist
				$this->session->set_flashdata('error', lang('error_link_not_found'));
				redirect($this->config->item('admin_folder').'/event');
			}
						
			//set values to db values
			$data['id']			= $event->id;
			$data['date']		= $event->date;
			$data['date_to']	= $event->date_to;
			$data['time']		= $event->time;
			$data['time_to']	= $event->time_to;
			$data['event']		= $event->event;				
			$data['venue']		= $event->venue;
			$data['brands']		= $event->brands;
			$data['status']		= $event->status;
			
		}
		
		$this->form_validation->set_rules('event', 'lang:event', 'trim|required');
		$this->form_validation->set_rules('date', 'lang:date', 'trim|required');
		$this->form_validation->set_rules('date_to', 'lang:date_to', 'trim|required');
		$this->form_validation->set_rules('time', 'lang:time', 'trim|required');
		$this->form_validation->set_rules('time_to', 'lang:time_to', 'trim|required');
		$this->form_validation->set_rules('brands', 'lang:brands', 'trim');
		$this->form_validation->set_rules('status', 'lang:status', 'trim');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/link_form', $data);
		}
		else
		{	
			$save = array();
			$save['id']			= $id;
			$save['event']		= $this->input->post('event');
			$save['date']		= $this->input->post('date'); 
			$save['date_to']	= $this->input->post('date_to');
						
			$save['time']		= $this->input->post('time');
			$save['time_to']		= $this->input->post('time_to');
			$save['venue']		= $this->input->post('venue');
			$save['brands']		= $this->input->post('brands');
			$save['status']		= $this->input->post('status');
			
			//save the event
			$this->event_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_link'));
			
			//go back to the event list
			redirect($this->config->item('admin_folder').'/event');
		}
	}
	
	/********************************************************************
	delete event
	********************************************************************/
	function delete($id)
	{
		
		$event	= $this->event_model->get_event($id);
		
		if($event)
		{
			$this->event_model->delete_event($id);
			$this->session->set_flashdata('message', lang('message_deleted_event'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/event');
	}
}	