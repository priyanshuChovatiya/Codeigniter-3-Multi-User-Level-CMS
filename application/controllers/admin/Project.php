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
		access_level('ADMIN');
		$this->load->model('admin/ProjectModel');
	}

	public function index()
	{
		$user_id = $this->session->userdata('login')['user_id'];
		$page_data['city'] = $this->db->select('id,name')->get_where('city', array('user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
		$page_data['job_type'] = $this->db->select('id,name')->get_where('job_type', array('user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
		$page_data['worker'] = $this->db->select('id,name')->get_where('user', array('type' => 'WORKER', 'user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
		$page_data['vendor'] = $this->db->select('id,name')->get_where('user', array('type' => 'VENDOR', 'user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
		$page_data['customer'] = $this->db->select('id,name')->get_where('user', array('type' => 'CUSTOMER', 'user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
		$page_data['page_title'] = 'Manage Projects';
		$page_data['page_name'] = 'admin/project/project-add';
		return $this->load->view('admin/common', $page_data);
	}

	public function add()
	{
		//Project data
		$this->form_validation->set_rules('name', 'Project Name ', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		// $this->form_validation->set_rules('worker', 'Worker', 'numeric');
		// $this->form_validation->set_rules('vendor', 'Vendor', 'numeric');
		$this->form_validation->set_rules('city', 'City', 'trim|required|numeric');
		$this->form_validation->set_rules('customer', 'Customer', 'trim|required|numeric');
		// $this->form_validation->set_rules('price', 'Price', '|numeric|greater_than_equal_to[0]');
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
		$this->form_validation->set_rules('project_image', 'Project Image', 'trim|mime_in[project_image,image/jpg,image/jpeg,image/png,]');

		if ($this->form_validation->run() == false) {
			$r['success'] = 0;
			$r['message'] = validation_errors();
		} else {
			$data = $this->input->post();

			$user = [];

			$user['name'] = $data['name'];
			$user['user_id'] = $this->session->userdata('login')['user_id'];
			$user['title'] = $data['title'];
			$user['city_id'] = $data['city'];
			$user['customer_id'] = $data['customer'];
			$user['start_date'] = $data['start_date'];
			$user['end_date'] = $data['end_date'];

			// upload image    first fileName and second pathName
			$project = imageUpload('project_image', 'project');
			if (!empty($project)) {
				$user['project_image'] = $project['file_name'];
			}

			$this->db->insert('project', $user);
			$project_id = $this->db->insert_id();

			$project_details = [];
			for ($i = 0; $i < count($data['job_type']); $i++) {
				$project_details[] = [
					'job_type_id' => $data['job_type'][$i],
					'worker_id'   => $data['worker'][$i],
					'vendor_id'   => $data['vendor'][$i],
					'price'    => $data['price'][$i],
					'project_id' => $project_id
				];
			}

			if (!empty($project_id)) {
				$this->db->insert_batch('project_detail', $project_details);
			}

			if (!empty($project_id)) {
				$r['success'] = 1;
				$r['message'] = "Project Created SuccessFully.";
			} else {
				$r['success'] = 0;
				$r['message'] = "Project Created Failed, Please Try again.";
			}
		}
		$this->session->set_flashdata('flash', $r);
		redirect(base_url('admin/project/report'), 'refresh');
	}

	public function report()
	{
		$page_data['page_title'] = 'User Report';
		$user_id = $this->session->userdata('login')['user_id'];
		$page_data['city'] = $this->db->select('id,name')->get_where('city', array('user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
		$page_data['worker'] = $this->db->select('id,name')->get_where('user', array('type' => 'WORKER', 'user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
		$page_data['vendor'] = $this->db->select('id,name')->get_where('user', array('type' => 'VENDOR', 'user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
		$page_data['customer'] = $this->db->select('id,name')->get_where('user', array('type' => 'CUSTOMER', 'user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
		$page_data['page_name'] = 'admin/project/project-report';
		return $this->load->view('admin/common', $page_data);
	}

	public function getProjectList()
	{
		$postData = $this->input->post();
		$data = $this->ProjectModel->getProjectReport($postData);
		echo json_encode($data);
	}

	public function edit($id)
	{
		try {
			$user_id = $this->session->userdata('login')['user_id'];
			$page_data['city'] = $this->db->select('id,name')->get_where('city', array('user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
			$page_data['data'] = $this->db->select('*')->get_where('project', array('id' => $id, 'user_id' => $user_id))->row_array();
			$page_data['job_type'] = $this->db->select('id,name')->get_where('job_type', array('user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
			$page_data['worker'] = $this->db->select('id,name')->get_where('user', array('type' => 'WORKER', 'user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
			$page_data['vendor'] = $this->db->select('id,name')->get_where('user', array('type' => 'VENDOR', 'user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
			$page_data['customer'] = $this->db->select('id,name')->get_where('user', array('type' => 'CUSTOMER', 'user_id' => $user_id, 'status' => 'ACTIVE'))->result_array();
			$page_data['project_detail'] = $this->db->select('*')->get_where('project_detail', array('project_id' => $id))->result_array();
			$page_data['id'] = $id;
			$page_data['page_title'] = 'Manage Project';
			$page_data['page_name'] = 'admin/project/project-add';
			return $this->load->view('admin/common', $page_data);
		} catch (\Throwable | \ErrorException | \Error | \Exception $e) {
			$r['success'] = 0;
			$r['message'] = $e->getMessage();
			$this->session->set_flashdata('flash', $r);
			redirect(base_url('admin/project/report'), 'refresh');
		}
	}

	public function update()
	{

		//Project data
		$this->form_validation->set_rules('name', 'Project Name ', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required|numeric');
		// $this->form_validation->set_rules('worker', 'Worker', 'trim|numeric');
		// $this->form_validation->set_rules('vendor', 'Vendor', 'trim|numeric');
		$this->form_validation->set_rules('customer', 'Customer', 'trim|required|numeric');
		// $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|greater_than_equal_to[0]');
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
		$this->form_validation->set_rules('project_image', 'Project Image', 'trim|mime_in[project_image,image/jpg,image/jpeg,image/png,]');

		if ($this->form_validation->run() == false) {
			$r['success'] = 0;
			$r['message'] = validation_errors();
		} else {
			$data = $this->input->post();
			$id = $data['id'];
			$store_data = [];

			$user_id = $this->session->userdata('login')['user_id'];

			$store_data['name'] = $data['name'];
			$store_data['user_id'] = $this->session->userdata('login')['user_id'];
			$store_data['title'] = $data['title'];
			$store_data['city_id'] = $data['city'];
			$store_data['customer_id'] = $data['customer'];
			$store_data['start_date'] = $data['start_date'];
			$store_data['end_date'] = $data['end_date'];

			$pd_id = $data['pd_id'];

			$project_detail_id = $this->db->select('id')->get_where('project_detail', array('project_id' => $id))->result_array();
			foreach ($project_detail_id as $value) {
				if (in_array($value['id'], $pd_id)) {
					$project_details = [];
					for ($i = 0; $i < count($data['job_type']); $i++) {
						$project_details[] = [
							'job_type_id' => $data['job_type'][$i],
							'worker_id'   => $data['worker'][$i],
							'vendor_id'   => $data['vendor'][$i],
							'price'    => $data['price'][$i],
						];
					}
				} else {
					echo "delete";
				}
			}
			exit;
			
			
			$this->db->update_batch('project_detail', $project_details, $value['id']);
			$fetch_data = $this->db->select('project_image')->get_where('project', array('id' => $id, 'user_id' => $user_id))->row_array();

			// upload image    first fileName and second pathName
			if ($this->input->post() && !empty($_FILES['profile']['name'])) {
				if (!empty($fetch_data['project_image'])) {
					if (file_exists('assets/uploads/project' . $fetch_data['project_image'])) {
						@unlink('assets/uploads/project' . $fetch_data['project_image']);
					}
				}
				$project = imageUpload('project_image', 'project');
				if (!empty($project)) {
					$store_data['project_image'] = $project['file_name'];
				}
			}

			$update = $this->db->where('id', $id)->where('user_id', $user_id)->update('project', $store_data);
			if (isset($update)) {
				$r['success'] = 1;
				$r['message'] = "Prodect Updated SuccessFully.";
			} else {
				$r['success'] = 0;
				$r['message'] = "Prodect Updated Failed, Please Try again.";
			}
		}
		$this->session->set_flashdata('flash', $r);
		redirect(base_url('admin/project/report'), 'refresh');
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
