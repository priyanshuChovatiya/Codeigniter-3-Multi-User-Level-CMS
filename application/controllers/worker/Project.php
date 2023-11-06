<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{

	public $form_validation;
	public $session;
	public $input;
	public $db;

	public function __construct()
	{
		parent::__construct();
		access_level('WORKER');
		$this->load->model('worker/ProjectModel');
	}

	// public function index()
	// {
	// 	$user_id = $this->session->userdata('login')['user_id'];
	// 	$page_data['city'] = $this->db->select('id,name')->get_where('city', array('user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
	// 	$page_data['page_title'] = 'Manage Projects';
	// 	$page_data['page_name'] = 'worker/project';
	// 	return $this->load->view('worker/common', $page_data);
	// }

	public function report()
	{
		$page_data['page_title'] = 'Project Report';
		$user_id = $this->session->userdata('login')['user_id'];
		$page_data['city'] = $this->db->select('id,name')->get_where('city', array('user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
		$page_data['worker'] = $this->db->select('id,name')->get_where('user', array('type' => 'WORKER', 'user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
		$page_data['vendor'] = $this->db->select('id,name')->get_where('user', array('type' => 'VENDOR', 'user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
		$page_data['customer'] = $this->db->select('id,name')->get_where('user', array('type' => 'CUSTOMER', 'user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
		$page_data['page_name'] = 'worker/project_report';
		return $this->load->view('worker/common', $page_data);
	}

	public function getProjectList()
	{
		$postData = $this->input->post();
		$data = $this->ProjectModel->getProjectReport($postData);
		echo json_encode($data);
	}
}
