<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		access_level('VENDOR');
	}

	public function index()
	{
		$page_data['page_title'] = 'Vendor Dashboard';
		$page_data['page_name'] = 'vendor/dashboard';
		return $this->load->view('vendor/common', $page_data);
	}
}

/* End of file Login.php */
