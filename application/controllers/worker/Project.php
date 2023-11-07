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

	public function status()
	{
		try {
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
			$this->form_validation->set_rules('id', 'Update Id', 'trim|required');
			$this->form_validation->set_rules('type', 'Status type', 'trim|required');

			if ($this->form_validation->run() == false) {
				$r['success'] = 0;
				$r['message'] = validation_errors();
			} else {
				$data = $this->input->post();
				$user_id = $this->session->userdata('login')['user_id'];
				$id = $data['id'];

				if ($data['type'] == 'status') {
					$response = $this->db->where(array('id' => $id, 'user_id' => $user_id))->update('project', ['status' => $data['status']]);
					if (isset($response)) {
						echo json_encode(['success' => true, 'message' => 'Status Updated successfully.']);
					} else {
						echo json_encode(['success' => false, 'error' => json_encode(validation_errors())]);
					}
				} elseif ($data['type'] == 'project_status') {
					$response = $this->db->where(array('id' => $id, 'user_id' => $user_id))->update('project', ['project_status' => $data['status']]);
					if (isset($response)) {
						echo json_encode(['success' => true, 'message' => 'Status Updated successfully.']);
					} else {
						echo json_encode(['success' => false, 'error' => json_encode(validation_errors())]);
					}
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
