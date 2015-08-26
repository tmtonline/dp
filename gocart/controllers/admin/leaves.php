<?php

class Leaves extends Admin_Controller {	

protected $activemenu 	= 'leaves';
	
	private $use_inventory = false;
	var $current_admin	= false;
	var $default_application_status	= "Pending";
	var $approve_application_status	= "Approved";
	
	function __construct()
	{		
		parent::__construct();
        
		//$this->auth->check_access('Admin', true);
		
		$this->load->model(array('Leave_model', 'Admin_model'));
		$this->load->helper('form');
		$this->lang->load('leave');
		
		$this->current_admin	= $this->session->userdata('admin');
	}

	public function date_compare($dateto, $datefrom)
	{
		// Get the value in the field
	    $datefrom = $_POST[$datefrom];	    	      

	    
	    if (strtotime($datefrom) > strtotime($dateto))
	    {
	    	$this->form_validation->set_message('date_compare', label('datefrom_bigger_than_dateto'));
	    	return FALSE;
	    }
	    else
	    {
	    	return TRUE;
	    }
	    	    		
	}		
	
	function index($order_by="leave_record.id", $sort_order="DESC", $code=0, $page=0, $rows=15)
	{	

		$access = $this->auth->check_access('Admin');						
		$data['activemenu'] 		= $this->activemenu;	
		$data['page_title']	= lang('leave_listing');
		
		$data['code']		= $code;
		$term				= false;
				
		$post				= $this->input->post(null, false);
		if($post)
		{
			$term			= json_encode($post);
		}
		
		//store the search term
		$data['term']		= $term;
		$data['order_by']	= $order_by;
		$data['sort_order']	= $sort_order;
		
		$data['leaves']	= $this->Leave_model->leaves(array('term'=>$term, 'order_by'=>$order_by, 'sort_order'=>$sort_order, 'rows'=>$rows, 'page'=>$page, 'auth_id'=> $this->current_admin['id'], 'access'=> $access));

		$data['annual_left']	= $this->Leave_model->get_total_trace($this->current_admin['id'], 'Annual Leave');	
		$data['sick_left']		= $this->Leave_model->get_total_trace($this->current_admin['id'], 'Sick Leave');
		
		//total number of leaves
		$data['total']		= $this->Leave_model->leaves(array('term'=>$term, 'order_by'=>$order_by, 'sort_order'=>$sort_order, 'auth_id'=> $this->current_admin['id'], 'access'=> $access), true);
		
		$this->load->library('pagination');
		
		$config['base_url']			= site_url($this->config->item('admin_folder').'/leaves/index/'.$order_by.'/'.$sort_order.'/'.$code.'/');
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
		
		$this->view($this->config->item('admin_folder').'/leaves', $data);
	}
	
	
	function bulk_save()
	{
		$leaves	= $this->input->post('leave');
		
		if(!$leaves)
		{
			$this->session->set_flashdata('error',  lang('error_bulk_no_leaves'));
			redirect($this->config->item('admin_folder').'/leaves');
		}
				
		foreach($leaves as $id=>$leave)
		{
			$leave['id']	= $id;
			$this->Leave_model->save($leave);
		}
		
		$this->session->set_flashdata('message', lang('message_bulk_update'));
		redirect($this->config->item('admin_folder').'/leaves');
	}
	
	function form($id = false, $duplicate = false)
	{
		$data['activemenu'] 		= $this->activemenu;
		// MC?		
		$this->leave_id	= $id;
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$data['page_title']		= lang('leave_form');

		//default values are empty if the leave is new
		$data['id']					= '';
		
		$data['application_date']	= '';
		$data['datefrom']			= '';
		$data['dateto']				= '';
		$data['leave_type']			= '';
		$data['day_type']			= '';
		$data['qty']				= '';
		$data['reason']				= '';
		$data['status']				= '';
		$data['doneby']				= '';
		
		$data['firstname']			= $this->current_admin['firstname'];
		$data['lastname']			= $this->current_admin['lastname'];
		//$data['employeeID']			= $this->current_admin['employeeID'];
		//$data['designation']		= $this->current_admin['designation'];
		$data['email']				= $this->current_admin['email'];
		
		
		if ($id)
		{				
			$leave					= $this->Leave_model->get_leave_full_details($id);
			
			//if the leave does not exist, redirect them to the leave list with an error
			if (!$leave)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/leaves');
			}
						
			$data['firstname'] 			= $leave->firstname;
			$data['lastname']  			= $leave->lastname;
			$data['email']  			= $leave->email;
			
			//set values to db values			
			$data['id']					= $id;
			$data['application_date']	= date('d-m-Y H:i:s', strtotime($leave->application_date)); 
			$data['datefrom']			= date('d-m-Y', strtotime($leave->datefrom)); 
			$data['dateto']				= date('d-m-Y', strtotime($leave->dateto)); 
			$data['leave_type']			= $leave->leave_type;
			$data['day_type']			= $leave->day_type;
			$data['qty']				= $leave->qty;
			$data['reason']				= $leave->reason;
			$data['status']				= $leave->status;
			$data['doneby']				= $leave->doneby;
												
		}
		
						
		$this->form_validation->set_rules('datefrom', 'lang:datefrom', 'trim|required');
		$this->form_validation->set_rules('dateto', 'lang:dateto', 'trim|required|callback_date_compare[datefrom]');
		$this->form_validation->set_rules('leave_type', 'lang:leave_type', 'trim|required');
		$this->form_validation->set_rules('day_type', 'lang:day_type', 'trim|required');
		
		// later on if qty of calculation is correct, here need do checking
		//$this->form_validation->set_rules('qty', 'lang:qty', 'trim|required|floatval');
		$this->form_validation->set_rules('reason', 'lang:reason', 'trim|required');
		$this->form_validation->set_rules('status', 'lang:status', 'trim');
	
		/*
		if we've posted already, get the photo stuff and organize it
		if validation comes back negative, we feed this info back into the system
		if it comes back good, then we send it with the save item
		
		submit button has a value, so we can see when it's posted
		*/
		
		if($duplicate)
		{
			$data['id']	= false;
		}
				
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/leave_form', $data);
		}
		else
		{
			$this->load->helper('text');									
			$today_date 	= date("Y-m-d H:i:s");
			
			$save['id']					= $id;
			$save['applicants']			= $this->current_admin['id'];
			$save['application_date']	= $today_date;
			
			$save['datefrom']			= date('Y-m-d', strtotime($this->input->post('datefrom')));
			$save['dateto']				= date('Y-m-d', strtotime($this->input->post('dateto')));
			$save['leave_type']			= $this->input->post('leave_type');
			$save['day_type']			= $this->input->post('day_type');			
			$save['reason']				= $this->input->post('reason');

			// checking how many days that applicate has taken
			$diff = abs(strtotime($this->input->post('dateto')) - strtotime($this->input->post('datefrom')));
			// to know how many days taken
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			//eg: 1/3 - 5/3 is 5 days so need add 1 or half day
			$day_type = 1;			
			if($save['day_type'] == 'First Half Leave' || $save['day_type'] == 'Second Half Leave'):
				$day_type = 0.5;			
			endif;
				
			$days = $days + $day_type;
			$save['qty']				= $days;
			
			// for who are emergency leave
			if($save['leave_type'] == 'Emergency Leave'){
				$save['status']				= $this->approve_application_status;
			}else{
				$save['status']				= $this->default_application_status;
			}												
								
			// save leave
			$leave_id	= $this->Leave_model->save($save);
			
			/**
			 * If emergency leave, direct insert into trace because it is aprrove directly
			 * need insert another table called leave_trace for if total of staff
			 */
			
			// another concern is, how emergency who go pick exceed one day?
			// for who are emergency leave
			if($save['leave_type'] == 'Emergency Leave'){
				$trace['applicants'] = $this->current_admin['id'];
				$trace['application_date'] = $today_date; // this is when insert this data
				$trace['recordID'] = $leave_id;
				$trace['leave_type'] = $save['leave_type'];
				$trace['out'] = $days;
				$trace['remark'] = 'Leave Apply by'.$this->current_admin['firstname'].' '.$this->current_admin['lastname'];			

				//insert into trace for future use
				$trace_id	= $this->Leave_model->save_trace($trace);
			}
			
			$message = $this->current_admin['firstname'].' '.$this->current_admin['lastname'].' has applied '.$save['leave_type'].' with '.$save['day_type'].' from '.$save['datefrom'].' until '.$save['dateto'];
			
			$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from($this->current_admin['email'], $this->current_admin['firstname'].' '.$this->current_admin['lastname']);
			$this->email->to('raymond@tmt.my');
			$this->email->cc('ongching@tmt.my');
			//$this->email->bcc($this->config->item('email'));
			$this->email->subject($this->current_admin['firstname'].' '.$this->current_admin['lastname'].' Leave Application');
			$this->email->message(html_entity_decode($message));
			$this->email->send();
			
			
			

			$this->session->set_flashdata('message', lang('message_saved_leave'));

			//go back to the leave list
			redirect($this->config->item('admin_folder').'/leaves');
		}
	}
	
	function admin_form($id = false, $duplicate = false)
	{
		// form for admin to judgement.
		$this->leave_id	= $id;

		if ($id)
		{
			$leave					= $this->Leave_model->get_leave_full_details($id);
				
			//if the leave does not exist, redirect them to the leaves list with an error
			if (!$leave)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/leaves');
			}			
		}else{
			//if they do not provide an id send them to the leave list page with an error
			$this->session->set_flashdata('error', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/leaves');
		}

		$this->load->helper('text');
		$today_date 	= date("Y-m-d H:i:s");
			
		$save['id']					= $id;			
		$save['status'] 			= $this->input->post('status');
		
		// save leave
		$leave_id	= $this->Leave_model->save($save);
			
		/**
		 * If emergency leave, direct insert into trace because it is aprrove directly
		 * need insert another table called leave_trace for if total of staff
		*/			
		// another concern is, how emergency who go pick exceed one day?
		// for who are emergency leave (This leave it there)
				
		//1 If admin approve, data will OUT qty day
		//  1.1 If admin after approved then rejected again under same ID, it will IN
		//  1.2 If admin after approved then approved again? IMPOSSIBLE
		//  ANS: So Form after approved, left rejected or Pending
		
		//2 If If admin reject in first time. trace wont insert anything
		//  1.2 If admin after rejected but then feel he ok, then approve again?
		//  ANS: So need check trace this record 
		
		// So how to checked?
		// Answer: Firstly, check the last row is it exist data or not?
		$trace_details = $this->Leave_model->get_last_trace_record($leave_id);	

		//set up trace details
		$trace['applicants'] = $leave->applicants;
		$trace['application_date'] = $today_date; // this is when insert this data
		$trace['recordID'] = $leave_id;		
		$trace['leave_type'] = $leave->leave_type;
		$trace['remark'] = $leave->firstname.' '.$leave->lastname.' apply leave been '. $save['status'];
		//deduct days
		$trace['out'] = $leave->qty;
		
		$must_insert = true;
		// So if got data, 
		if($trace_details):
			if($save['status'] == 'Rejected'):
				//return back the date back to applicants
				$trace['in'] = $leave->qty;
				$trace['out'] = 0;
			endif;
		else:
			if($save['status'] == 'Rejected'):
				$must_insert = false;
			endif;
		endif;
		
		if($must_insert):
			//insert into trace for future use
			$trace_id	= $this->Leave_model->save_trace($trace);
		endif;
		
		//send email update applicants that their application success or fail?
		
		
		$this->session->set_flashdata('message', lang('message_saved_leave'));

		//go back to the leave list
		redirect($this->config->item('admin_folder').'/leaves');
	
	}
	
	//Cancel it
	function cancel_form($id = false)
	{
		$save['id']					= $id;
		$save['status'] 			= "Cancelled";		
		// save leave
		$leave_id	= $this->Leave_model->save($save);
		$this->session->set_flashdata('message', lang('message_saved_leave'));		
		//go back to the leave list
		redirect($this->config->item('admin_folder').'/leaves');
	}
	
	function delete($id = false)
	{
		if ($id)
		{	
			$leave	= $this->Leave_model->get_leave($id);
			//if the leave does not exist, redirect them to the customer list with an error
			if (!$leave)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/leaves');
			}
			else
			{				
				//if the leave is legit, delete them
				$this->Leave_model->delete_leave($id);
				$this->session->set_flashdata('message', lang('message_deleted_leave'));
				redirect($this->config->item('admin_folder').'/leaves');
			}
		}
		else
		{
			//if they do not provide an id send them to the leave list page with an error
			$this->session->set_flashdata('error', lang('error_not_found'));
			redirect($this->config->item('admin_folder').'/leaves');
		}
	}
	
	function leave_adjustment_form($id = false)
	{		
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	
		$data['page_title']		= lang('leave_adjustment_form');
		
		$data['annual_left']	= $this->Leave_model->get_total_trace($id, 'Annual Leave');
		$data['sick_left']		= $this->Leave_model->get_total_trace($id, 'Sick Leave');
	
		//default values are empty if the leave is new
		$data['id']					= '';

		$data['application_date']	= '';		
		$data['adjustment_type']	= '';
		$data['qty']				= '';
		$data['reason']				= '';
		
		$data['firstname']			= '';
		$data['lastname']			= '';
		$data['email']				= '';

		if ($id)
		{
			//here is direct read admin table, no need join table
			$admin					= $this->Admin_model->admin($id);
				
			//if the leave does not exist, redirect them to the leave list with an error
			if (!$admin)
			{
				$this->session->set_flashdata('error', lang('error_not_found'));
				redirect($this->config->item('admin_folder').'/admin');
			}

			$data['firstname'] 			= $admin->firstname;
			$data['lastname']  			= $admin->lastname;
			$data['email']  			= $admin->email;				
			$data['id']					= $id;			
		}

		$this->form_validation->set_rules('adjustment_type', 'lang:adjustment_type', 'trim|required');		
		$this->form_validation->set_rules('remark', 'lang:remark', 'trim');		
		/*
		 if we've posted already, get the photo stuff and organize it
		if validation comes back negative, we feed this info back into the system
		if it comes back good, then we send it with the save item

		submit button has a value, so we can see when it's posted
		*/

		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/leave_adjustment_form', $data);
		}
		else
		{
			$this->load->helper('text');
			$today_date 	= date("Y-m-d H:i:s");			
				
			/**
			 * If emergency leave, direct insert into trace because it is aprrove directly
			 * need insert another table called leave_trace for if total of staff
			*/						
			$adjustment_type			= $this->input->post('adjustment_type');
			$leave_type					= $this->input->post('leave_type');
				
			if($adjustment_type == 'in'){
				$trace['in'] = $this->input->post('qty');
			}else{
				$trace['out'] = $this->input->post('qty');
			}
						
			//admin selected
			$trace['applicants'] = $id;
			$trace['application_date'] = $today_date; // this is when insert this data
			$trace['recordID'] = 0;
			$trace['leave_type'] = $leave_type;			
			
			$trace['remark'] = $this->input->post('remark');

			//insert into trace for future use
			$trace_id	= $this->Leave_model->save_trace($trace);
			
			$this->session->set_flashdata('message', lang('message_done_adjust_leave'));

			//go back to the leave list
			redirect($this->config->item('admin_folder').'/admin');
		}
	}
	
	function viewleavespdf($start = '', $end = '', $applicants = '', $leave_type = '', $day_type = '', $status = '')
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('leave_application');
		$this->load->helper('date');
		$this->load->helper('pdf');
		/* $start		= $this->input->post('start');
		$end		= $this->input->post('end');
		$leave_type	= $this->input->post('leave_type');
		$day_type	= $this->input->post('day_type');
		$status		= $this->input->post('status');		
		$applicants = $this->input->post('applicants'); */
		
		$leaves		= $this->Leave_model->get_leave_listing($start, $end, $applicants, $leave_type, $day_type, $status);
		$pdf_leaves = generate_pdf_leaves($leaves, $start, $end);
	}
	
	function bulk_leave()
	{	
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('leave_application');
		$data['staffs']		= $this->Admin_model->get_staffs();
		
		$this->view($this->config->item('admin_folder').'/leaves', $data);
	}
	
		
		
	function leave_listing()
	{
		$data['activemenu'] = $this->activemenu;
		$data['page_title']	= lang('daily_reports');
		$this->load->helper('date');
		
		$start		= $this->input->post('start');
		$end		= $this->input->post('end');
		
		//$start		= '2015-07-29';
		//$end		= '2015-07-29';
		
		$leave_type	= $this->input->post('leave_type');
		$day_type	= $this->input->post('day_type');
		$status		= $this->input->post('status');		
		$applicants = $this->input->post('applicants');
		
		$data['start']				= $start;
		$data['end']				= $end;
		$data['applicants']			= $applicants;
		$data['leave_type']			= $leave_type;
		$data['day_type']			= $day_type;
		$data['status']				= $status;
		
		$data['leaves']	= $this->Leave_model->get_leave_listing($start, $end, $applicants, $leave_type, $day_type, $status);
	
		$this->load->view($this->config->item('admin_folder').'/leaves/leave_listing', $data);
	}
	
}
