<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Work extends CI_Controller
{

	public $form_validation;
	public $session;
	public $input;
	public $db;

	public function __construct()
	{
		parent::__construct();
		access_level_admin();
		$this->load->model('admin/WorkModel');
	}

	public function index()
	{
		$page_data['page_title'] = 'Manage Work';
		$page_data['page_name'] = 'admin/work/work-add';
		return $this->load->view('admin/common', $page_data);
	}

	public function add()
	{
		//work data
		$this->form_validation->set_rules('name', 'Work Name ', 'trim|required');
		if ($this->form_validation->run() == false) {
			$r['success'] = 0;
			$r['message'] = validation_errors();
		} else {
			$data = $this->input->post();
			$work = [];

			$work['name'] = $data['name'];
			$work['user_id'] = $this->session->userdata('login')['user_id'];

			$insert = $this->db->insert('work', $work);
			if (isset($insert)) {
				$r['success'] = 1;
				$r['message'] = "Work Add SuccessFully.";
			} else {
				$r['success'] = 0;
				$r['message'] = "Work Add Failed, Please Try again.";
			}
		}
		$this->session->set_flashdata('flash', $r);
		redirect(base_url('admin/work'), 'refresh');
	}

	public function getWorkList()
	{
		$postData = $this->input->post();
		$data = $this->WorkModel->getWork($postData);
		echo json_encode($data);
	}

	public function edit($update_id)
	{
		try {
			$id = decrypt_id($update_id);
			$user_id = $this->session->userdata('login')['user_id'];
			$page_data['data'] = $this->db->select('id,name')->get_where('work', array('id' => $id, 'user_id' => $user_id))->row_array();
			$page_data['id'] = $update_id;
			$page_data['page_title'] = 'Manage Work';
			$page_data['page_name'] = 'admin/work/work-add';
			return $this->load->view('admin/common', $page_data);
		} catch (\Throwable | \ErrorException | \Error | \Exception $e) {
			$r['success'] = 0;
			$r['message'] = $e->getMessage();
			$this->session->set_flashdata('flash', $r);
			redirect(base_url('admin/work'), 'refresh');
		}
	}

	public function update()
	{
		$data = $this->input->post();
		$id = decrypt_id($data['id']);

		$this->form_validation->set_rules('name', 'Full Name ', 'trim|required');
		if ($this->form_validation->run() == false) {
			$r['success'] = 0;
			$r['message'] = validation_errors();
		} else {
			$user_id = $this->session->userdata('login')['user_id'];
			$update = $this->db->where('id', $id)->where('user_id', $user_id)->update('work', ['name' => $data['name']]);
			if (isset($update)) {
				$r['success'] = 1;
				$r['message'] = "Work Updated SuccessFully.";
			} else {
				$r['success'] = 0;
				$r['message'] = "Work Updated Failed, Please Try again.";
			}
		}
		$this->session->set_flashdata('flash', $r);
		redirect(base_url('admin/work'), 'refresh');
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
				$id = decrypt_id($data['id']);

				$response = $this->db->where(array('id' => $id, 'user_id' => $user_id))->update('work', ['status' => $data['status']]);

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
