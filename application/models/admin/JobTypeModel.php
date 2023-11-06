<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JobTypeModel extends CI_Model
{

	public function getJobType($postData = null)
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


		## Total number of records without filtering
		$totalRecords = $this->db->select('*')->from('job_type')->where('user_id', $user_id)->get()->num_rows();


		## Total number of record with filtering
		$totalRecordwithFilter = $this->db->select('*')->from('job_type')->where('user_id', $user_id)->get()->num_rows();

		## Fetch records
		$records = $this->db->select('*')->from('job_type')->where('user_id', $user_id)
					->order_by($columnName, $columnSortOrder)
					->limit($rowperpage, $start)
					->get()->result();

		$data = array();
		$i = $start + 1;
		foreach ($records as $record) {

			$id = $record->id;
			$link = base_url('admin/jobType/edit/') . $id;
			$checked = $record->status == 'ACTIVE' ? "checked" : "";
			
			$action = "<div class='d-flex gap-1'><a href='{$link}'><button type='button' class='btn btn-sm btn-dark rounded-pill btn-icon' data-bs-toggle='modal' > <i class='mdi mdi-pencil-outline'></i> </button><a/>";

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
