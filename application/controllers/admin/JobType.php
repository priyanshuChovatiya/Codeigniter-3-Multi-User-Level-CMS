<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JobType extends CI_Controller
{

	public $form_validation;
	public $session;
	public $input;
	public $db;

	public function __construct()
	{
		parent::__construct();
		access_level('ADMIN');
		$this->load->model('admin/JobTypeModel');
	}

	public function index()
	{
		$page_data['page_title'] = 'Manage Job Types';
		$page_data['page_name'] = 'admin/jobType/jobType-add';
		return $this->load->view('admin/common', $page_data);
	}

	public function add()
	{
		//work data
		$this->form_validation->set_rules('name', 'Job Type Name ', 'trim|required');
		if ($this->form_validation->run() == false) {
			$r['success'] = 0;
			$r['message'] = validation_errors();
		} else {
			$data = $this->input->post();
			$job_type = [];

			$job_type['name'] = $data['name'];
			$job_type['user_id'] = $this->session->userdata('login')['user_id'];

			$insert = $this->db->insert('job_type', $job_type);
			if (isset($insert)) {
				$r['success'] = 1;
				$r['message'] = "Job Type Add SuccessFully.";
			} else {
				$r['success'] = 0;
				$r['message'] = "Job Type Add Failed, Please Try again.";
			}
		}
		$this->session->set_flashdata('flash', $r);
		redirect(base_url('admin/jobType'), 'refresh');
	}

	public function getJobTypeList()
	{
		$postData = $this->input->post();
		$data = $this->JobTypeModel->getJobType($postData);
		echo json_encode($data);
	}

	public function edit($id)
	{
		try {
			$user_id = $this->session->userdata('login')['user_id'];
			$page_data['data'] = $this->db->select('id,name')->get_where('job_type', array('id' => $id, 'user_id' => $user_id))->row_array();
			$page_data['id'] = $id;
			$page_data['page_title'] = 'Manage Job Types';
			$page_data['page_name'] = 'admin/jobType/jobType-add';
			return $this->load->view('admin/common', $page_data);
		} catch (\Throwable | \ErrorException | \Error | \Exception $e) {
			$r['success'] = 0;
			$r['message'] = $e->getMessage();
			$this->session->set_flashdata('flash', $r);
			redirect(base_url('admin/jobType'), 'refresh');
		}
	}

	public function update()
	{
		$data = $this->input->post();
		$id = $data['id'];

		$this->form_validation->set_rules('name', 'Full Name ', 'trim|required');
		if ($this->form_validation->run() == false) {
			$r['success'] = 0;
			$r['message'] = validation_errors();
		} else {
			$user_id = $this->session->userdata('login')['user_id'];
			$update = $this->db->where('id', $id)->where('user_id', $user_id)->update('job_type', ['name' => $data['name']]);
			if (isset($update)) {
				$r['success'] = 1;
				$r['message'] = "Job Type Updated SuccessFully.";
			} else {
				$r['success'] = 0;
				$r['message'] = "Job Type Updated Failed, Please Try again.";
			}
		}
		$this->session->set_flashdata('flash', $r);
		redirect(base_url('admin/jobType'), 'refresh');
	}

	public function status()
	{
		try {
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
			$this->form_validation->set_rules('id', 'Update Id', 'trim|required');

			if ($this->form_validation->run() == false) {
				$r['success'] = 0;
				$r['message'] = validation_errors();
			} else {
				$data = $this->input->post();
				$user_id = $this->session->userdata('login')['user_id'];
				$id = $data['id'];

				$response = $this->db->where(array('id' => $id, 'user_id' => $user_id))->update('job_type', ['status' => $data['status']]);

				if (isset($response)) {
					echo json_encode(['success' => true, 'message' => 'Status Updated successfully.']);
				} else {
					echo json_encode(['success' => false, 'error' => json_encode(validation_errors())]);
				}
			}
		} catch (\Throwable | \ErrorException | \Error | \Exception $e) {
			$message = [
				'success' => false,
				'error' => $e->getMessage(),
				'data' => []
			];
			echo json_encode($message);
		}
	}
}
