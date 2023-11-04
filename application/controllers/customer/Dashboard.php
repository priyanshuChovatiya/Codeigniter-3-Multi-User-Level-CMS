<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		access_level('CUSTOMER');
	}

	public function index()
	{
		$page_data['page_title'] = 'Customer Dashboard';
		$page_data['page_name'] = 'customer/dashboard';
		return $this->load->view('customer/common', $page_data);
	}
}

/* End of file Login.php */
