<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_payment extends CI_Controller
{

	public $form_validation;
	public $session;
	public $input;
	public $db;

	public function __construct()
	{
		parent::__construct();
		access_level('ADMIN');
		$this->load->model('admin/PaymentModel');
	}

	public function index()
	{
		$page_data['page_title'] = 'Manage Payment';
		$page_data['page_name'] = 'admin/payment';
		$admin_id = $this->session->userdata('login')['user_id'];

		$this->db->select('user.id,user.name,user.type,job_type.name as job_type')
			->from('user')
			->join('job_type', 'job_type.id = user.job_type_id', 'left')
			->where(array('user.user_id' => $admin_id, 'user.status' => 'ACTIVE', 'user.type !=' => 'ADMIN'));
		$page_data['user'] = $this->db->get()->result_array();
		return $this->load->view('admin/common', $page_data);
	}

	public function add()
	{
		//payment data
		$this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
		$this->form_validation->set_rules('amount', 'amount', 'trim|required');
		$this->form_validation->set_rules('date', 'date', 'trim|required');
		$this->form_validation->set_rules('type', 'type', 'trim|required');

		if ($this->form_validation->run() == false) {
			$r['success'] = 0;
			$r['message'] = validation_errors();
			$this->session->set_flashdata('flash', $r);
			redirect(base_url('admin/manage_payment'), 'refresh');
		} else {
			$data = $this->input->post();
			// pre($data);exit;
			$payment = [];

			$payment['user_id'] = $data['user_id'];
			$payment['amount'] = $data['amount'];
			$payment['date'] = $data['date'];
			$payment['type'] = $data['type'];

			$insert = $this->db->insert('payment', $payment);

			if (isset($insert)) {
				$r['success'] = 1;
				$r['message'] = "payment details Add SuccessFully.";
			} else {
				$r['success'] = 0;
				$r['message'] = "Payment Details Add Failed, Please Try again.";
			}
		}
		$this->session->set_flashdata('flash', $r);
		redirect(base_url('admin/manage_payment'), 'refresh');
	}

	public function getPaymentList()
	{
		$postData = $this->input->post();
		$data = $this->PaymentModel->getPayment($postData);
		echo json_encode($data);
	}

	public function edit($id)
	{
		try {
			$admin_id = $this->session->userdata('login')['user_id'];
			$page_data['id'] = $id;
			$this->db->select('user.id,user.name,user.type,job_type.name as job_type')
				->from('user')
				->join('job_type', 'job_type.id = user.job_type_id', 'left')
				->where(array('user.user_id' => $admin_id, 'user.status' => 'ACTIVE', 'user.type !=' => 'ADMIN'));
			$page_data['user'] = $this->db->get()->result_array();
			$page_data['data'] = $this->db->select('*')->get_where('payment', array('id' => $id))->row_array();
			$page_data['page_title'] = 'Manage Payment';
			$page_data['page_name'] = 'admin/payment';
			return $this->load->view('admin/common', $page_data);
		} catch (\Throwable | \ErrorException | \Error | \Exception $e) {
			$r['success'] = 0;
			$r['message'] = $e->getMessage();
			$this->session->set_flashdata('flash', $r);
			redirect(base_url('admin/manage_payment'), 'refresh');
		}
	}

	public function update()
	{
		$data = $this->input->post();
		$id = $data['id'];

		$this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
		$this->form_validation->set_rules('amount', 'amount', 'trim|required');
		$this->form_validation->set_rules('date', 'date', 'trim|required');
		$this->form_validation->set_rules('type', 'type ', 'required');

		if ($this->form_validation->run() == false) {
			$r['success'] = 0;
			$r['message'] = validation_errors();
		} else {

			$update = $this->db->where('id', $id)->update('payment', ['user_id' => $data['user_id'], 'amount' => $data['amount'], 'date' => $data['date'], 'type' => $data['type']]);
			if (isset($update)) {
				$r['success'] = 1;
				$r['message'] = "Payment Details Updated SuccessFully.";
			} else {
				$r['success'] = 0;
				$r['message'] = "Payment Details Updated Failed, Please Try again.";
			}
		}
		$this->session->set_flashdata('flash', $r);
		redirect(base_url('admin/manage_payment'), 'refresh');
	}
}
