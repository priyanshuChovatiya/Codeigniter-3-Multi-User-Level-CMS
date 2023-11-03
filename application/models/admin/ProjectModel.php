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
			$worker_id = array('project.worker_id' => $postData['worker_id']);
		} else {
			$worker_id = array();
		}
		if (!empty($postData['vendor_id'])) {
			$vendor_id = array('project.vendor_id' => $postData['vendor_id']);
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


		## Total number of records without filtering
		$query = $this->db->select('project.*, worker.name as worker_name, vendor.name as vendor_name, customer.name as customer_name')
			->from('project')
			->join('user as worker', 'project.worker_id = worker.id', 'left')
			->join('user as vendor', 'project.vendor_id = vendor.id', 'left')
			->join('user as customer', 'project.customer_id = customer.id', 'left')
			->where('project.user_id', $user_id)->where($worker_id)->where($vendor_id)->where($customer_id)->where($status);
		if (!empty($postData['search'])) {
			$query->like('project.name', $postData['search']);
		}
		$totalRecords = $this->db->get()->num_rows();


		## Total number of record with filtering
		$recordstotalRecord = $this->db->select('project.*, worker.name as worker_name, vendor.name as vendor_name, customer.name as customer_name')
			->from('project')
			->join('user as worker', 'project.worker_id = worker.id', 'left')
			->join('user as vendor', 'project.vendor_id = vendor.id', 'left')
			->join('user as customer', 'project.customer_id = customer.id', 'left')
			->where('project.user_id', $user_id)->where($worker_id)->where($vendor_id)->where($customer_id)->where($status);
		if (!empty($postData['search'])) {
			$recordstotalRecord->like('project.name', $postData['search']);
		}
		$totalRecordwithFilter = $this->db->get()->num_rows();

		## Fetch records
		$records = $this->db->select('project.*, worker.name as worker_name, vendor.name as vendor_name, customer.name as customer_name')
			->from('project')
			->join('user as worker', 'project.worker_id = worker.id', 'left')
			->join('user as vendor', 'project.vendor_id = vendor.id', 'left')
			->join('user as customer', 'project.customer_id = customer.id', 'left')
			->where('project.user_id', $user_id)->where($worker_id)->where($vendor_id)->where($customer_id)->where($status);
		if (!empty($postData['search'])) {
			$records->like('project.name', $postData['search']);
		}
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		$Allrecords = $this->db->get()->result();

		$data = array();
		$i = $start + 1;
		foreach ($Allrecords as $record) {

			$id = encrypt_id($record->id);
			$link = base_url('admin/project/edit/') . $id;
			$image_link = base_url('assets/uploads/project/').$record->project_image;
			$checked = $record->status == 'ACTIVE' ? "checked" : "";
			
			$action = "<div class='d-flex gap-1'><a href='{$link}'><button type='button' class='btn btn-sm btn-dark rounded-pill btn-icon' data-bs-toggle='modal' > <i class='mdi mdi-pencil-outline'></i> </button><a/>";
			$action .= "<a href='{$image_link}' target='_blank'><button type='button' class=' btn btn-sm btn-primary rounded-pill btn-icon' ><i class='mdi mdi-eye'></i></button><a/> </div>";

			$status = " <label class='switch switch-success'>
                                <input type='checkbox' data-id='$id' data-status='{$record->status}' data-on='ACTIVE' data-value='1' data-off='INACTIVE'
                                    class='switch-input status' {$checked} />
                                <span class='switch-toggle-slider'>
                                    <span class='switch-on'></span>
                                    <span class='switch-off'></span>
                                </span>
                                <span class='switch-label'>{$record->status}</span>
                            </label>";

			$data[] = array(
				"id" => $i++,
				"action" => $action,
				"name" => $record->name,
				"title" => $record->title,
				"worker" => $record->worker_name,
				"vendor" => $record->vendor_name,
				"customer" => $record->customer_name,
				"price" => $record->price,
				"start_date" => $record->start_date,
				"end_date" => $record->end_date,
				"status" => $status,
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
