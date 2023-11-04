<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		access_level('ADMIN');
	}

	public function index()
	{
		$page_data['page_title'] = 'Admin Dashboard';
		$page_data['page_name'] = 'admin/dashboard';
		return $this->load->view('admin/common', $page_data);
	}
}

/* End of file Login.php */
