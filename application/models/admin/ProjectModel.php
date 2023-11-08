<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProjectModel extends CI_Model
{

	public function getProjectReport($postData = null)
	{

		$response = array();

		## Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		// $searchValue = $postData['search']['value']; // Search value
		$user_id = $this->session->userdata('login')['user_id'];

		if (!empty($postData['worker_id'])) {
			$worker_id = array('project_detail.worker_id' => $postData['worker_id']);
		} else {
			$worker_id = array();
		}
		if (!empty($postData['vendor_id'])) {
			$vendor_id = array('project_detail.vendor_id' => $postData['vendor_id']);
		} else {
			$vendor_id = array();
		}
		if (!empty($postData['customer_id'])) {
			$customer_id = array('project.customer_id' => $postData['customer_id']);
		} else {
			$customer_id = array();
		}
		if (!empty($postData['status'])) {
			$status = array('project.status' => $postData['status']);
		} else {
			$status = array();
		}
		if (!empty($postData['city'])) {
			$city = array('project.city_id' => $postData['city']);
		} else {
			$city = array();
		}


		## Total number of records without filtering
		$query = $this->db->select('project.*,customer.name as customer_name,city.name as city_name')
			->from('project')
			->join('user as customer', 'project.customer_id = customer.id', 'left')
			->join('project_detail', 'project.id = project_detail.project_id', 'left')
			->join('city', 'project.city_id = city.id', 'left')
			->where('project.user_id', $user_id)->where($customer_id)->where($status)->where($city)->where($worker_id)->where($vendor_id);
		if (!empty($postData['search'])) {
			$query->like('project.name', $postData['search']);
		}
		$this->db->group_by('project_detail.project_id');
		$totalRecords = $this->db->get()->num_rows();


		## Total number of record with filtering
		$recordstotalRecord = $this->db->select('project.*,customer.name as customer_name,city.name as city_name')
			->from('project')
			->join('user as customer', 'project.customer_id = customer.id', 'left')
			->join('project_detail', 'project.id = project_detail.project_id', 'left')
			->join('city', 'project.city_id = city.id', 'left')
			->where('project.user_id', $user_id)->where($customer_id)->where($status)->where($city)->where($worker_id)->where($vendor_id);
		if (!empty($postData['search'])) {
			$recordstotalRecord->like('project.name', $postData['search']);
		}
		$this->db->group_by('project_detail.project_id');
		$totalRecordwithFilter = $this->db->get()->num_rows();

		## Fetch records
		$records = $this->db->select('project.*,customer.name as customer_name,city.name as city_name')
			->from('project')
			->join('user as customer', 'project.customer_id = customer.id', 'left')
			->join('project_detail', 'project.id = project_detail.project_id', 'left')
			->join('city', 'project.city_id = city.id', 'left')
			->where('project.user_id', $user_id)->where($customer_id)->where($status)->where($city)->where($worker_id)->where($vendor_id);
		if (!empty($postData['search'])) {
			$records->like('project.name', $postData['search']);
		}
		$this->db->group_by('project_detail.project_id');
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		$Allrecords = $this->db->get()->result();

		$data = array();
		$i = $start + 1;

		foreach ($Allrecords as $record) {

			$this->db->select('project_detail.*, worker.name as worker_name, vendor.name as vendor_name,job_type.name as job_name')
				->from('project_detail')
				->join('user as worker', 'project_detail.worker_id = worker.id', 'left')
				->join('user as vendor', 'project_detail.vendor_id = vendor.id', 'left')
				->join('job_type', 'project_detail.job_type_id = job_type.id', 'left')
				->where('project_detail.project_id', $record->id)->where($worker_id)->where($vendor_id);
			$project_details = $this->db->get()->result_array();
			
			$worker_html = "";
			$vendor_html = "";
			$job_type_html = "";
			$price_html = "";
			foreach ($project_details as $value) {
				$worker_html .= "<span>{$value['worker_name']}</span><br>";
				$vendor_html .= "<span>{$value['vendor_name']}</span><br>";
				$job_type_html .= "<span>{$value['job_name']}</span><br>";
				$price_html .= "<span>{$value['price']}</span><br>";
			}

			$id = $record->id;
			$link = base_url('admin/project/edit/') . $id;
			$image_link = base_url('assets/uploads/project/') . $record->project_image;
			$checked = $record->status == 'ACTIVE' ? "checked" : "";
			$Pending = ($record->project_status == 'PENDING') ? 'selected' : '';
			$InProcess = ($record->project_status == 'INPROCESS') ? 'selected' : '';
			$Complated = ($record->project_status == 'COMPLATED') ? 'selected' : '';

			$action = "<div class='d-flex gap-1'><a href='{$link}'><button type='button' class='btn btn-sm btn-dark rounded-pill btn-icon' data-bs-toggle='modal' > <i class='mdi mdi-pencil-outline'></i> </button><a/>";
			$action .= "<a href='{$image_link}' target='_blank'><button type='button' class=' btn btn-sm btn-primary rounded-pill btn-icon' ><i class='mdi mdi-eye'></i></button><a/> </div>";

			$status = " <label class='switch switch-success' style='width: 85px;'>
                                <input type='checkbox' data-id='$id' data-status='{$record->status}' data-on='ACTIVE' data-value='1' data-off='INACTIVE'
                                    class='switch-input status' {$checked} />
                                <span class='switch-toggle-slider'>
                                    <span class='switch-on'></span>
                                    <span class='switch-off'></span>
                                </span>
                                <span class='switch-label'>{$record->status}</span>
                            </label>";
			$project_status = "<div class='form-floating form-floating-outline' style='width: 130px;'>
								<select name='project_status' class='select2 form-select project_status' data-id='$id' data-allow-clear='true' data-current-status='" . $record->project_status . "'>
									<option value='PENDING' $Pending>PENDING</option>
									<option value='INPROCESS' $InProcess>INPROCESS</option>
									<option value='COMPLATED' $Complated>COMPLATED</option>
								</select>
							</div>";

			$data[] = array(
				"id" => $i++,
				"action" => $action,
				"name" => $record->name,
				"title" => $record->title,
				"city" => $record->city_name,
				"job_type" => $job_type_html,
				"worker" => $worker_html,
				"vendor" => $vendor_html,
				"customer" => $record->customer_name,
				"price" => $price_html,
				"start_date" => $record->start_date,
				"end_date" => $record->end_date,
				"status" => $status,
				"project_status" => $project_status,
			);
		}
		## Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return $response;
	}
}
