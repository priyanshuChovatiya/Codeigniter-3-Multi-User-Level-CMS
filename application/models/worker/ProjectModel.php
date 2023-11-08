<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProjectModel extends CI_Model
{

	// public function getProjectReport($postData = null)
	// {

	// 	$response = array();

	// 	## Read value
	// 	$draw = $postData['draw'];
	// 	$start = $postData['start'];
	// 	$rowperpage = $postData['length']; // Rows display per page
	// 	$columnIndex = $postData['order'][0]['column']; // Column index
	// 	$columnName = $postData['columns'][$columnIndex]['data']; // Column name
	// 	$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
	// 	// $searchValue = $postData['search']['value']; // Search value
	// 	$user_id = $this->session->userdata('login')['user_id'];

	// 	if (!empty($postData['worker_id'])) {
	// 		$worker_id = array('project.worker_id' => $postData['worker_id']);
	// 	} else {
	// 		$worker_id = array();
	// 	}
	// 	if (!empty($postData['vendor_id'])) {
	// 		$vendor_id = array('project.vendor_id' => $postData['vendor_id']);
	// 	} else {
	// 		$vendor_id = array();
	// 	}
	// 	if (!empty($postData['customer_id'])) {
	// 		$customer_id = array('project.customer_id' => $postData['customer_id']);
	// 	} else {
	// 		$customer_id = array();
	// 	}
	// 	if (!empty($postData['status'])) {
	// 		$status = array('project.status' => $postData['status']);
	// 	} else {
	// 		$status = array();
	// 	}
	// 	if (!empty($postData['city'])) {
	// 		$city = array('project.city_id' => $postData['city']);
	// 	} else {
	// 		$city = array();
	// 	}


	// 	## Total number of records without filtering
	// 	$query = $this->db->select('project.*,customer.name as customer_name,city.name as city_name,worker.name as worker_name,vendor.name as vendor_name,project_detail.price')
	// 		->from('project')
	// 		->join('project_detail', 'project.id = project_detail.project_id', 'left')
	// 		->join('user as customer', 'project.customer_id = customer.id', 'left')
	// 		->join('user as worker', 'project_detail.worker_id = worker.id', 'left')
	// 		->join('user as vendor', 'project_detail.vendor_id = vendor.id', 'left')
	// 		->join('city', 'project.city_id = city.id', 'left')
	// 		->where(array('project_detail.worker_id'=>$user_id,'project.project_status !='=>'COMPLATED'))->where($customer_id)->where($status)->where($city)->where($worker_id)->where($vendor_id);
	// 	if (!empty($postData['search'])) {
	// 		$query->like('project.name', $postData['search']);
	// 	}
	// 	$totalRecords = $this->db->get()->num_rows();


	// 	## Total number of record with filtering
	// 	$recordstotalRecord = $this->db->select('project.*,customer.name as customer_name,city.name as city_name,worker.name as worker_name,vendor.name as vendor_name,project_detail.price')
	// 		->from('project')
	// 		->join('project_detail', 'project.id = project_detail.project_id', 'left')
	// 		->join('user as customer', 'project.customer_id = customer.id', 'left')
	// 		->join('user as worker', 'project_detail.worker_id = worker.id', 'left')
	// 		->join('user as vendor', 'project_detail.vendor_id = vendor.id', 'left')
	// 		->join('city', 'project.city_id = city.id', 'left')
	// 		->where(array('project_detail.worker_id'=>$user_id,'project.project_status !='=>'COMPLATED'))->where($customer_id)->where($status)->where($city)->where($worker_id)->where($vendor_id);
	// 	if (!empty($postData['search'])) {
	// 		$recordstotalRecord->like('project.name', $postData['search']);
	// 	}
	// 	$totalRecordwithFilter = $this->db->get()->num_rows();

	// 	## Fetch records
	// 	$records = $this->db->select('project.*,customer.name as customer_name,city.name as city_name,worker.name as worker_name,vendor.name as vendor_name,project_detail.price')
	// 		->from('project')
	// 		->join('project_detail', 'project.id = project_detail.project_id', 'left')
	// 		->join('user as customer', 'project.customer_id = customer.id', 'left')
	// 		->join('user as worker', 'project_detail.worker_id = worker.id', 'left')
	// 		->join('user as vendor', 'project_detail.vendor_id = vendor.id', 'left')
	// 		->join('city', 'project.city_id = city.id', 'left')
	// 		->where(array('project_detail.worker_id'=>$user_id,'project.project_status !='=>'COMPLATED'))->where($customer_id)->where($status)->where($city)->where($worker_id)->where($vendor_id);
	// 	if (!empty($postData['search'])) {
	// 		$records->like('project.name', $postData['search']);
	// 	}
	// 	$this->db->order_by($columnName, $columnSortOrder);
	// 	$this->db->limit($rowperpage, $start);
	// 	$Allrecords = $this->db->get()->result();

	// 	$data = array();
	// 	$i = $start + 1;

	// 	foreach ($Allrecords as $record) {
	// 		$project_status = "";
	// 		if($record->project_status == 'PENDING'){
	// 			$project_status.= "<span class='badge bg-warning'>PENDING</span>";
	// 		}elseif($record->project_status == 'INPROCESS'){
	// 			$project_status.= "<span class='badge bg-info'>IN PROGRESS</span>";
	// 		}

	// 		$data[] = array(
	// 			"id" => $i++,
	// 			"name" => $record->name,
	// 			"title" => $record->title,
	// 			"city" => $record->city_name,
	// 			"worker" => $record->worker_name,
	// 			"vendor" => $record->vendor_name,
	// 			"customer" => $record->customer_name,
	// 			"price" => $record->price,
	// 			"start_date" => $record->start_date,
	// 			"end_date" => $record->end_date,
	// 			"project_status" => $project_status,
	// 		);
	// 	}
	// 	## Response
	// 	$response = array(
	// 		"draw" => intval($draw),
	// 		"iTotalRecords" => $totalRecords,
	// 		"iTotalDisplayRecords" => $totalRecordwithFilter,
	// 		"aaData" => $data
	// 	);

	// 	return $response;
	// }

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

<<<<<<< HEAD
=======
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
		if (!empty($postData['worker_status'])) {
			$worker_status = array('project_detail.worker_status' => $postData['worker_status']);
		} else {
			$worker_status = array();
		}
		if (!empty($postData['vendor_status'])) {
			$vendor_status = array('project_detail.vendor_status' => $postData['vendor_status']);
		} else {
			$vendor_status = array();
		}
		if (!empty($postData['city'])) {
			$city = array('project.city_id' => $postData['city']);
		} else {
			$city = array();
		}
>>>>>>> 954640e6a85ba5d8447ec5666f457fb16d4e6b05

		if (!empty($postData['from_date'])) {
			$from_date = array('project.from_date' => $postData['from_date']);
		} else {
			$from_date = array();
		}
		if (!empty($postData['to_date'])) {
			$to_date = array('project.to_date' => $postData['to_date']);
		} else {
			$to_date = array();
		}
		if (!empty($postData['project_status'])) {
			$project_status = array('project.project_status' => $postData['project_status']);
		} else {
			$project_status = array();
		}

		## Total number of records without filtering
<<<<<<< HEAD
		$query = $this->db->select('project_detail.*, worker.name as worker_name, vendor.name as vendor_name')
			->from('project_detail')
			->join('user as worker', 'project_detail.worker_id = worker.id', 'left')
			->join('user as vendor', 'project_detail.vendor_id = vendor.id', 'left')
			->where('project_detail.worker_id', $user_id);
		// ->where('project.user_id', $user_id)->where($start_date)->where($status)->where($end_date);

=======
		$query = $this->db->select('project.*,customer.name as customer_name,city.name as city_name')
			->from('project')
			->join('user as customer', 'project.customer_id = customer.id', 'left')
			->join('project_detail', 'project.id = project_detail.project_id', 'left')
			->join('city', 'project.city_id = city.id', 'left')
			->where(array('project_detail.worker_id' => $user_id, 'project.project_status !=' => 'COMPLATED'))->where($worker_status)->where($vendor_status)->where($city)->where($worker_id)->where($vendor_id);
>>>>>>> 954640e6a85ba5d8447ec5666f457fb16d4e6b05
		if (!empty($postData['search'])) {
			$query->like('project.name', $postData['search']);
		}
		$this->db->group_by('project_detail.project_id');
		$totalRecords = $this->db->get()->num_rows();


		## Total number of record with filtering
<<<<<<< HEAD
		$recordstotalRecord = $this->db->select('project_detail.*, worker.name as worker_name, vendor.name as vendor_name')
			->from('project_detail')
			->join('user as worker', 'project_detail.worker_id = worker.id', 'left')
			->join('user as vendor', 'project_detail.vendor_id = vendor.id', 'left')
			->where('project_detail.worker_id', $user_id);
		// ->where('project.user_id', $user_id)->where($start_date)->where($status)->where($end_date);
=======
		$recordstotalRecord = $this->db->select('project.*,customer.name as customer_name,city.name as city_name')
			->from('project')
			->join('user as customer', 'project.customer_id = customer.id', 'left')
			->join('project_detail', 'project.id = project_detail.project_id', 'left')
			->join('city', 'project.city_id = city.id', 'left')
			->where(array('project_detail.worker_id' => $user_id, 'project.project_status !=' => 'COMPLATED'))->where($worker_status)->where($vendor_status)->where($city)->where($worker_id)->where($vendor_id);
>>>>>>> 954640e6a85ba5d8447ec5666f457fb16d4e6b05
		if (!empty($postData['search'])) {
			$recordstotalRecord->like('project.name', $postData['search']);
		}
		$this->db->group_by('project_detail.project_id');
		$totalRecordwithFilter = $this->db->get()->num_rows();


		## Fetch records
<<<<<<< HEAD
		$records = 	$this->db->select('project_detail.*, worker.name as worker_name, vendor.name as vendor_name,city.name as city_name,customer.name as customer_name,project.customer_id,project.start_date,project.end_date,project.project_image,project.project_status,project.name,project.title')
			->from('project_detail')
			->join('user as worker', 'project_detail.worker_id = worker.id', 'left')
			->join('user as vendor', 'project_detail.vendor_id = vendor.id', 'left')
			->join('project', 'project_detail.project_id = project.id', 'left')
			->join('city', 'project_detail.project_id = city.id', 'left')
			->join('user as customer', 'project_detail.project_id = customer.id', 'left')
			->where('project_detail.worker_id', $user_id);
		// ->where('project.user_id', $user_id)->where($start_date)->where($status)->where($end_date);

=======
		$records = $this->db->select('project.*,customer.name as customer_name,city.name as city_name')
			->from('project')
			->join('user as customer', 'project.customer_id = customer.id', 'left')
			->join('project_detail', 'project.id = project_detail.project_id', 'left')
			->join('city', 'project.city_id = city.id', 'left')
			->where(array('project_detail.worker_id' => $user_id, 'project.project_status !=' => 'COMPLATED'))->where($worker_status)->where($vendor_status)->where($city)->where($worker_id)->where($vendor_id);
>>>>>>> 954640e6a85ba5d8447ec5666f457fb16d4e6b05
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

<<<<<<< HEAD
			// $this->db->select('project_detail.*, worker.name as worker_name, vendor.name as vendor_name')
			// 	->from('project_detail')
			// 	->join('user as worker', 'project_detail.worker_id = worker.id', 'left')
			// 	->join('user as vendor', 'project_detail.vendor_id = vendor.id', 'left')
			// 	->join('project', 'project_detail.project_id=project.id', 'left')
			// 	->where('project_detail.worker_id', $user_id);
			// $project_details = $this->db->get()->result_array();


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
=======
			$this->db->select('project_detail.*, worker.name as worker_name, vendor.name as vendor_name,job_type.name as job_name,worker.mobile as worker_mobile, worker.email as worker_email,vendor.mobile as vendor_mobile,vendor.email as vendor_email')
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
			$worker_mobile = "";
			$worker_email = "";
			$vendor_mobile = "";
			$vendor_email = "";
			$worker_status = "";
			$vendor_status = "";
			$action = "";
			foreach ($project_details as $value) {
				$worker_html .= "<span>{$value['worker_name']}</span><br>";
				$vendor_html .= "<span>{$value['vendor_name']}</span><br>";
				$job_type_html .= "<span>{$value['job_name']}</span><br>";
				$price_html .= "<span>{$value['price']}</span><br>";
				$worker_mobile .= "<span>{$value['worker_mobile']}</span><br>";
				$worker_email .= "<span>{$value['worker_email']}</span><br>";
				$vendor_mobile .= "<span>{$value['vendor_mobile']}</span><br>";
				$vendor_email .= "<span>{$value['vendor_email']}</span><br>";

				if($value['worker_status'] == "PENDING"){
					$worker_status .= "<span class='badge bg-warning'>PENDING</span> <br>" ;
					// $worker_status .=  ($user_id == $value['worker_id']) ? '<button type="button" class="btn btn-sm btn-success me-2 rounded-pill btn-icon approved ms-1" data-id="'.$value['id'].'" data-status="PENDING" ><span class="mdi mdi-check"></span> </button>' : '';
					$action .=  ($user_id == $value['worker_id']) ? '<button type="button" class="btn btn-sm btn-danger me-2 rounded-pill btn-icon inprogress ms-1" data-id="'.$value['id'].'" data-status="INPROGRESS" ><i class="mdi mdi-timer-sand"></i></button>' : '';
				}elseif($value['worker_status'] == "INPROCESS"){
					$worker_status .= "<span class='badge bg-info'>IN PROGRESS</span> <br>";
					$action .=  ($user_id == $value['worker_id']) ? '<div class="d-flex gap-1"><button type="button" class="btn btn-sm btn-success me-2 rounded-pill btn-icon approved ms-1" data-id="'.$value['id'].'" data-status="PENDING" ><span class="mdi mdi-check"></span> </button>' : '';
					$action .=  ($user_id == $value['worker_id'] && $value['worker_status'] == "INPROCESS") ? '<button type="button" class="btn btn-sm btn-primary me-2 rounded-pill btn-icon viewImage ms-1" data-id="'.$value['id'].'"><i class="mdi mdi-eye"></i></button> </div>' : '';
				}elseif($value['worker_status'] == "COMPLATED"){
					$worker_status .= "<span class='badge bg-success'>COMPLATED</span> <br>";
					$action .=  ($user_id == $value['worker_id'] && $value['worker_status'] == "COMPLATED") ? '<button type="button" class="btn btn-sm btn-primary me-2 rounded-pill btn-icon viewImage ms-1" data-id="'.$value['id'].'"><i class="mdi mdi-eye"></i></button>' : '';
				}

				if($value['vendor_status'] == "PENDING"){
					$vendor_status .= "<span class='badge bg-warning'>PENDING</span>";
				}elseif($value['vendor_status'] == "INPROCESS"){
					$vendor_status .= "<span class='badge bg-info'>IN PROGRESS</span>";
				}elseif($value['vendor_status'] == "COMPLATED"){
					$vendor_status .= "<span class='badge bg-success'>COMPLATED</span>";
				}
			}

			$project_status = "";
			if ($record->project_status == 'PENDING') {
				$project_status .= "<span class='badge bg-warning'>PENDING</span>";
			} elseif ($record->project_status == 'INPROCESS') {
				$project_status .= "<span class='badge bg-info'>IN PROGRESS</span>";
			}

>>>>>>> 954640e6a85ba5d8447ec5666f457fb16d4e6b05



			$data[] = array(
				"id" => $i++,
<<<<<<< HEAD
				"action" => $action,
				"city" => $record->city_name,
=======
>>>>>>> 954640e6a85ba5d8447ec5666f457fb16d4e6b05
				"name" => $record->name,
				"action" => $action,
				"title" => $record->title,
<<<<<<< HEAD
				"worker" => $record->worker_name,
				"vendor" => $record->vendor_name,
				"customer" => $record->customer_name,
				"price" => $record->price,
				"project_status" => $project_status,
				"start_date" => $record->start_date,
				"end_date" => $record->end_date,
=======
				"city" => $record->city_name,
				"job_type" => $job_type_html,
				"worker" => $worker_html,
				"worker_status" => $worker_status,
				'w_mobile' => $worker_mobile,
				'w_email' => $worker_email,
				"vendor" => $vendor_html,
				"vendor_status" => $vendor_status,
				'v_mobile' => $vendor_mobile,
				'v_email' => $vendor_email,
				"customer" => $record->customer_name,
				"price" => $price_html,
				"start_date" => $record->start_date,
				"end_date" => $record->end_date,
				"project_status" => $project_status,
>>>>>>> 954640e6a85ba5d8447ec5666f457fb16d4e6b05
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
