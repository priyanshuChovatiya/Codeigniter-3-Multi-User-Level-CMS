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
		$user_id = $this->session->userdata('login')['user_id'];
		$this->db->select('project.*,customer.name as customer_name,city.name as city_name')
			->from('project')
			->join('user as customer', 'project.customer_id = customer.id', 'left')
			->join('project_detail', 'project.id = project_detail.project_id', 'left')
			->join('city', 'project.city_id = city.id', 'left')
			->where(array('project.project_status !=' => 'COMPLATED',"FIND_IN_SET(project_detail.worker_id , $user_id)"))
			->GROUP_BY('project.id')
			->order_by('project.id', 'desc');
		$Allrecords = $this->db->get()->result_array();
		$page_data['project_data'] = $Allrecords;
		$page_data['page_title'] = 'Worker Dashboard';
		$page_data['page_name'] = 'worker/dashboard';
		return $this->load->view('worker/common', $page_data);
	}
}

/* End of file Login.php */
