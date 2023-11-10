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
		$page_data['city'] = $this->db->select('id,name')->get_where('city', array('status' => 'ACTIVE'))->result_array();
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

	public function update_status()
	{
		$this->form_validation->set_rules('id', 'Update Id', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

		if ($this->form_validation->run() == false) {
			$r['success'] = 0;
			$r['message'] = validation_errors();
		} else {
			$data = $this->input->post();

			$user_id = $this->session->userdata('login')['user_id'];
			$user_type = $this->session->userdata('login')['user_type'];
			$id = $data['id'];
			$insert_data = [];

			$arraydata = [];
			$files = $_FILES;
			$images = $_FILES['work_image']['name'];

			$files = $_FILES;
			$cpt = count($_FILES['work_image']['name']);
			for ($i = 0; $i < $cpt; $i++) {
				$_FILES['work_image']['name'] = $files['work_image']['name'][$i];
				$_FILES['work_image']['type'] = $files['work_image']['type'][$i];
				$_FILES['work_image']['tmp_name'] = $files['work_image']['tmp_name'][$i];
				$_FILES['work_image']['error'] = $files['work_image']['error'][$i];
				$_FILES['work_image']['size'] = $files['work_image']['size'][$i];

				$config = array();
				$config['upload_path'] = 'assets/uploads/work_image';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['encrypt_name'] = TRUE;
				$config['overwrite']     = FALSE;
				$this->upload->initialize($config);

				if (!empty($this->upload->do_upload('work_image'))) {
					$upload_data = $this->upload->data();

					$insert_data['name'] =  $upload_data['file_name'];
					$insert_data['project_detail_id'] = $id;
					$insert_data['type'] = $data['status'];
					$this->db->insert('project_detail_image', $insert_data);
				}

				$convertimg = FCPATH . "assets/uploads/work_image/" . $upload_data['file_name'];
				$convertimgsize = filesize($convertimg) / 1024;
				if ($convertimgsize > 300) {

					$info = getimagesize($convertimg);
					if ($info['mime'] == 'image/jpeg')
						$iiimage = imagecreatefromjpeg($convertimg);
					elseif ($info['mime'] == 'image/png')
						$iiimage = imagecreatefrompng($convertimg);

					list($width, $height) = getimagesize($_FILES['work_image']['tmp_name']);
					$tn = imagecreatetruecolor($width, $height);

					imagecopyresampled($tn, $iiimage, 0, 0, 0, 0, $width, $height, $width, $height);
					imagejpeg($iiimage, $convertimg, 20);
				}
			}
			$update_data = [];
			$update_data['worker_status'] = $data['status'];
			$update_data['worker_remark'] = $data['remark'];

			$response = $this->db->where(array('id' => $id, 'worker_id' => $user_id))->update('project_detail', $update_data);

			if (isset($response)) {
				$r['success'] = 1;
				$r['message'] = "Your Status Updated successfully.";
			} else {
				$r['success'] = 0;
				$r['message'] = "Your Status Updated Failed.";
			}
		}
		$this->session->set_flashdata('flash', $r);
		redirect(base_url('worker/project/report'), 'refresh');
	}

	public function viewActivity()
	{
		$user_id = $this->session->userdata('login')['user_id'];
		$activity_id = $this->input->post('activity_id');
		$date = date('Y-m-d');
		$this->db->select('daily_activity.work_complate,daily_activity.remark,activity_image.name')
			->from('daily_activity')
			->join('activity_image', 'daily_activity.id = activity_image.activity_id', 'left')
			->where(array('user_id' => $user_id, 'date' => $date));
		$page_data['data'] = $this->db->get()->result_array();
		$res = $this->load->view('worker/view_activity.php', $page_data);
		echo json_encode($res);
	}

	public function presonalImage()
	{
		// $user_id = $this->session->userdata('login')['user_id'];
		$user_id = $this->input->post('user_id');
		$project_id = $this->input->post('project_id');
		$date = date('Y-m-d');
		$this->db->select('daily_activity.work_complate,daily_activity.remark,activity_image.name')
			->from('daily_activity')
			->join('activity_image', 'daily_activity.id = activity_image.activity_id', 'left')
			->where(array('user_id' => $user_id, 'date' => $date, 'project_id' => $project_id));
		$page_data['data'] = $this->db->get()->result_array();
		$res = $this->load->view('worker/view_activity.php', $page_data);
		echo json_encode($res);
	}

	public function view_detail($id)
	{
		$user_id = $this->session->userdata('login')['user_id'];

		$this->db->select('project.*,customer.name as customer_name,city.name as city_name')
			->from('project')
			->join('user as customer', 'project.customer_id = customer.id', 'left')
			->join('project_detail', 'project.id = project_detail.project_id', 'left')
			->join('city', 'project.city_id = city.id', 'left')
			->where(array('project.id' => $id));
			$page_data['data'] = $this->db->get()->row_array();
			
			$this->db->select('project_detail.*,
			GROUP_CONCAT(DISTINCT worker.name ORDER BY worker.id ASC SEPARATOR ",") as worker_name, 
			GROUP_CONCAT(DISTINCT vendor.name ORDER BY vendor.id ASC SEPARATOR ",") as vendor_name,
			GROUP_CONCAT(DISTINCT job_type.name SEPARATOR ",") as job_name,
			GROUP_CONCAT(DISTINCT worker.mobile ORDER BY worker.id ASC SEPARATOR ",") as worker_mobile,
			GROUP_CONCAT(DISTINCT worker.email ORDER BY worker.id ASC SEPARATOR ",") as worker_email,
			GROUP_CONCAT(DISTINCT vendor.mobile ORDER BY vendor.id ASC SEPARATOR ",") as vendor_mobile,
			GROUP_CONCAT(DISTINCT vendor.email ORDER BY vendor.id ASC SEPARATOR ",") as vendor_email,
			GROUP_CONCAT(DISTINCT worker.profile ORDER BY worker.id ASC SEPARATOR ",") as worker_profile,
			GROUP_CONCAT(DISTINCT project_detail.worker_status SEPARATOR ",") as worker_status')
			->from('project_detail')
			->join('user as worker', "FIND_IN_SET(worker.id, project_detail.worker_id)", 'left')
			->join('user as vendor', "FIND_IN_SET(vendor.id, project_detail.vendor_id)", 'left')
			->join('job_type', 'project_detail.job_type_id = job_type.id', 'left')
			->where('project_detail.project_id', $id)
			->group_by('project_detail.id');
			$page_data['worker'] = $this->db->get()->result_array();
			
			
		// 	$this->db->select('daily_activity.work_complate,worker.name as worker_name,job_type.name as job_type')
		// 		->from('daily_activity')
		// 		->join('project_detail', 'project_detail.project_id = daily_activity.project_id', 'left')
		// 		->join('user as worker', "FIND_IN_SET(worker.id, project_detail.worker_id)", 'left')
		// 		->join('job_type', 'daily_activity.job_type = job_type.id', 'left')
		// 		->where(array('daily_activity.project_id' => $id,))
		// 		->group_by('daily_activity.id');
		// $page_data['complated_work'] = $this->db->get()->result_array();
		// pre($page_data);exit;
		$page_data['project_id'] = $id;
		$page_data['page_title'] = 'Project Details';
		$page_data['page_name'] = 'worker/view_detail';
		return $this->load->view('worker/common', $page_data);
	}

	public function daily_work($id)
	{

		$this->form_validation->set_rules('work_complate', 'Work Complated', 'trim|required');

		if ($this->form_validation->run() == false) {
			$r['success'] = 0;
			$r['message'] = validation_errors();
		} else {
			$user_id = $this->session->userdata('login')['user_id'];
			$job_type = $this->session->userdata('login')['job_type'];

			$data = $this->input->post();
			$daily_activity = [];

			$daily_activity['user_id'] = $user_id;
			$daily_activity['project_id'] = $id;
			$daily_activity['job_type'] = $job_type;
			$daily_activity['date'] =  date('Y-m-d');
			$daily_activity['remark'] = isset($data['remark']) ? $data['remark'] : '';
			$daily_activity['work_complate'] = $data['work_complate'];

			$this->db->insert('daily_activity', $daily_activity);
			$insert_id = $this->db->insert_id();


			$files = $_FILES;
			$cpt = count($_FILES['work_image']['name']);
			for ($i = 0; $i < $cpt; $i++) {
				$_FILES['work_image']['name'] = $files['work_image']['name'][$i];
				$_FILES['work_image']['type'] = $files['work_image']['type'][$i];
				$_FILES['work_image']['tmp_name'] = $files['work_image']['tmp_name'][$i];
				$_FILES['work_image']['error'] = $files['work_image']['error'][$i];
				$_FILES['work_image']['size'] = $files['work_image']['size'][$i];

				$config = array();
				$config['upload_path'] = 'assets/uploads/daily_activity/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['encrypt_name'] = TRUE;
				$config['overwrite']     = FALSE;
				$this->upload->initialize($config);

				if (!empty($this->upload->do_upload('work_image')) && !empty($insert_id)) {
					$upload_data = $this->upload->data();
					$insert_data['activity_id'] = $insert_id;
					$insert_data['name'] =  $upload_data['file_name'];
					$this->db->insert('activity_image', $insert_data);
				}
			}

			$convertimg = FCPATH . "assets/uploads/daily_activity/" . $upload_data['file_name'];
			$convertimgsize = filesize($convertimg) / 1024;
			if ($convertimgsize > 300) {

				$info = getimagesize($convertimg);
				if ($info['mime'] == 'image/jpeg')
					$iiimage = imagecreatefromjpeg($convertimg);
				elseif ($info['mime'] == 'image/png')
					$iiimage = imagecreatefrompng($convertimg);

				list($width, $height) = getimagesize($_FILES['work_image']['tmp_name']);
				$tn = imagecreatetruecolor($width, $height);

				imagecopyresampled($tn, $iiimage, 0, 0, 0, 0, $width, $height, $width, $height);
				imagejpeg($iiimage, $convertimg, 20);
			}

			if (!empty($insert_id)) {
				$r['success'] = 1;
				$r['message'] = "Daily Activity Add successfully.";
			} else {
				$r['success'] = 0;
				$r['message'] = "Daily Activity Add Failed.";
			}
		}
		$this->session->set_flashdata('flash', $r);
		redirect(base_url('worker/project/view_detail/' . $id), 'refresh');
	}
}
