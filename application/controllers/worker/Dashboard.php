<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		access_level('WORKER');
	}

	public function index()
	{
		$page_data['page_title'] = 'Worker Dashboard';
		$page_data['page_name'] = 'worker/dashboard';
		return $this->load->view('worker/common', $page_data);
	}
}

/* End of file Login.php */
