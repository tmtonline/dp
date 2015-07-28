<?php

class Dashboard extends Admin_Controller {
	
	protected $activemenu 	= 'dashboard';

	function __construct()
	{
		parent::__construct();

		if($this->auth->check_access('Orders'))
		{
			redirect($this->config->item('admin_folder').'/orders');
		}
		
		$this->load->model(array('Order_model', 'Customer_model', 'Leave_model'));		
		$this->load->helper('date');
		$lang = $this->session->userdata('lang');
		$this->lang->load('dashboard', $lang);
	}
	
	function index()
	{
		$data['activemenu'] 		= $this->activemenu;
		//check to see if shipping and payment modules are installed
		$data['payment_module_installed']	= (bool)count($this->Settings_model->get_settings('payment_modules'));
		$data['shipping_module_installed']	= (bool)count($this->Settings_model->get_settings('shipping_modules'));												

		$leaves	= $this->Leave_model->leaves(array('order_by'=>'leave_record.id', 'sort_order'=>'DESC', 'status'=> 'Approved', 'calendar'=>true));
		
		$data['page_title']	=  lang('calendar');
		
		// get 5 latest orders
		$data['orders']	= $this->Order_model->get_orders(false, '' , 'DESC', 5);

		// get 5 latest customers
		$data['customers'] = $this->Customer_model->get_customers(5);
				
		
		$this->view($this->config->item('admin_folder').'/dashboard', $data);
	}
	
	public function ajax_get_leaves()
	{
		$leaves	= $this->Leave_model->leaves(array('order_by'=>'leave_record.id', 'sort_order'=>'DESC', 'status'=> 'Approved', 'calendar'=>true));
		header('Content-type: application/json');
		echo json_encode($leaves);
	}
	
	


}