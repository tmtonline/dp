<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function generate_pdf_leaves($leaves_data, $start, $end, $stream = TRUE)
{
	$CI = &get_instance();
	
	$data = array(
			'leaves'   				=> $leaves_data,			
			'output_type'       	=> 'pdf',
	);
	$html = $CI->load->view('admin/pdf_templates/leaves', $data, TRUE);	
	$CI->load->helper('mpdf');
		
	// statement name and month file
	$filename = 'leaves_'.strtolower(trim(preg_replace('#\W+#', '_', $start.'_'.$end) , '_'));
	
	return pdf_create($html, $filename , $stream);
}


