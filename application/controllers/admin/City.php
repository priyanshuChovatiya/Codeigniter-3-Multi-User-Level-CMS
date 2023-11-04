<?php


defined('BASEPATH') or exit('No direct script access allowed');

class City extends CI_Controller
{

	public $form_validation;
	public $session;
	public $input;
	public $db;

	public function __construct()
	{
		parent::__construct();
		access_level('ADMIN');
		$this->load->model('admin/CityModel');
	}

	public function index()
	{
		$page_data['page_title'] = 'Manage City';
		$page_data['page_name'] = 'admin/city/city-add';
		return $this->load->view('admin/common', $page_data);
	}

	public function add()
	{
		//city data
		$this->form_validation->set_rules('name', 'City Name ', 'trim|required');
		if ($this->form_validation->run() == false) {
			$r['success'] = 0;
			$r['message'] = validation_errors();
		} else {
			$data = $this->input->post();
			$city = [];

			$city['name'] = $data['name'];
			$city['user_id'] = $this->session->userdata('login')['user_id'];

			$insert = $this->db->insert('city', $city);
			if (isset($insert)) {
				$r['success'] = 1;
				$r['message'] = "City Add SuccessFully.";
			} else {
				$r['success'] = 0;
				$r['message'] = "City Add Failed, Please Try again.";
			}
		}
		$this->session->set_flashdata('flash', $r);
		redirect(base_url('admin/city'), 'refresh');
	}

	public function getCityList()
	{
		$postData = $this->input->post();
		$data = $this->CityModel->getCity($postData);
		echo json_encode($data);
	}

	public function edit($id)
	{
		try {
			$user_id = $this->session->userdata('login')['user_id'];
			$page_data['data'] = $this->db->select('id,name')->get_where('city', array('id' => $id, 'user_id' => $user_id))->row_array();
			$page_data['id'] = $id;
			$page_data['page_title'] = 'Manage City';
			$page_data['page_name'] = 'admin/city/city-add';
			return $this->load->view('admin/common', $page_data);
		} catch (\Throwable | \ErrorException | \Error | \Exception $e) {
			$r['success'] = 0;
			$r['message'] = $e->getMessage();
			$this->session->set_flashdata('flash', $r);
			redirect(base_url('admin/city'), 'refresh');
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
			$user = $this->db->where('id', $id)->where('user_id', $user_id)->update('city', ['name' => $data['name']]);
			if (isset($user)) {
				$r['success'] = 1;
				$r['message'] = "City Updated SuccessFully.";
			} else {
				$r['success'] = 0;
				$r['message'] = "City Updated Failed, Please Try again.";
			}
		}
		$this->session->set_flashdata('flash', $r);
		redirect(base_url('admin/city'), 'refresh');
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

				$response = $this->db->where(array('id' => $id, 'user_id' => $user_id))->update('city', ['status' => $data['status']]);

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
