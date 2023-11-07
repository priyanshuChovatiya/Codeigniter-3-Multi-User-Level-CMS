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


		if (!empty($postData['start_date'])) {
			$start_date = array('project.start_date' => $postData['start_date']);
		} else {
			$start_date = array();
		}
		if (!empty($postData['end_date'])) {
			$end_date = array('project.end_date' => $postData['end_date']);
		} else {
			$end_date = array();
		}
		if (!empty($postData['status'])) {
			$status = array('project.status' => $postData['status']);
		} else {
			$status = array();
		}

		## Total number of records without filtering
		$query = $this->db->select('project_detail.*, worker.name as worker_name, vendor.name as vendor_name')
			->from('project_detail')
			->join('user as worker', 'project_detail.worker_id = worker.id', 'left')
			->join('user as vendor', 'project_detail.vendor_id = vendor.id', 'left')
			->where('project_detail.vendor_id', $user_id);
		// ->where('project.user_id', $user_id)->where($start_date)->where($status)->where($end_date);

		if (!empty($postData['search'])) {
			$query->like('project.name', $postData['search']);
		}
		$totalRecords = $this->db->get()->num_rows();


		## Total number of record with filtering
		$recordstotalRecord = $this->db->select('project_detail.*, worker.name as worker_name, vendor.name as vendor_name')
			->from('project_detail')
			->join('user as worker', 'project_detail.worker_id = worker.id', 'left')
			->join('user as vendor', 'project_detail.vendor_id = vendor.id', 'left')
			->where('project_detail.vendor_id', $user_id);
		// ->where('project.user_id', $user_id)->where($start_date)->where($status)->where($end_date);
		if (!empty($postData['search'])) {
			$recordstotalRecord->like('project.name', $postData['search']);
		}
		$totalRecordwithFilter = $this->db->get()->num_rows();


		## Fetch records
		$records = 	$this->db->select('project_detail.*, worker.name as worker_name, vendor.name as vendor_name,city.name as city_name,customer.name as customer_name,project.customer_id,project.start_date,project.end_date,project.project_image,project.project_status,project.name,project.title')
			->from('project_detail')
			->join('user as worker', 'project_detail.worker_id = worker.id', 'left')
			->join('user as vendor', 'project_detail.vendor_id = vendor.id', 'left')
			->join('project', 'project_detail.project_id = project.id', 'left')
			->join('city', 'project_detail.project_id = city.id', 'left')
			->join('user as customer', 'project_detail.project_id = customer.id', 'left')
			->where('project_detail.vendor_id', $user_id);
		// ->where('project.user_id', $user_id)->where($start_date)->where($status)->where($end_date);

		if (!empty($postData['search'])) {
			$records->like('project.name', $postData['search']);
		}
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		$Allrecords = $this->db->get()->result();

		$data = array();
		$i = $start + 1;

		foreach ($Allrecords as $record) {


			$id = $record->id;
			$image_link = base_url('assets/uploads/project/') . $record->project_image;
			$Pending = ($record->project_status == 'PENDING') ? 'selected' : '';
			$InProcess = ($record->project_status == 'INPROCESS') ? 'selected' : '';
			$Complated = ($record->project_status == 'COMPLATED') ? 'selected' : '';

			$action = "<a href='{$image_link}' target='_blank'><button type='button' class=' btn btn-sm btn-primary rounded-pill btn-icon' ><i class='mdi mdi-eye'></i></button><a/> </div>";

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
				"city" => $record->city_name,
				"name" => $record->name,
				"title" => $record->title,
				"worker" => $record->worker_name,
				"vendor" => $record->vendor_name,
				"customer" => $record->customer_name,
				"price" => $record->price,
				"project_status" => $project_status,
				"start_date" => $record->start_date,
				"end_date" => $record->end_date,
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
