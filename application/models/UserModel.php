<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{

	public function getUsers($postData = null)
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

		if(!empty($postData['user_type'])){
			$type = array('type'=>$postData['user_type']);
		}else{
			$type = array();
		}
		if(!empty($postData['status'])){
			$status = array('status'=>$postData['status']);
		}else{
			$status = array();
		}
		
		
		## Total number of records without filtering
		$query = $this->db->select('*')->from('user')->where('user_id', $user_id)->where($type)->where($status);
		if(!empty($postData['search'])){
			$query->like('name', $postData['search']);
		}
		$totalRecords = $this->db->get()->num_rows();
		
		
		## Total number of record with filtering
		$recordstotalRecord = $this->db->select('*')->from('user')->where('user_id', $user_id)->where($type)->where($status);
		if(!empty($postData['search'])){
			$recordstotalRecord->like('name', $postData['search']);
		}
		$totalRecordwithFilter = $this->db->get()->num_rows();

		## Fetch records
		$records = $this->db->select('*')->from('user')->where('user_id', $user_id)->where($type)->where($status);
		if(!empty($postData['search'])){
			$records->like('name', $postData['search']);
		}
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		$Allrecords = $this->db->get()->result();

		$data = array();
		$i = $start + 1;
		foreach ($Allrecords as $record) {

			$id = $record->id;
			// $id = encrypter($row->id);
                $link = base_url('admin/user/edit/') . $id;
                $checked = $record->status == 'ACTIVE' ? "checked" : "";

                $action = "<button type='button' class='btn btn-sm btn-primary rounded-pill btn-icon permission' data-bs-toggle='modal' data-id='" . $id . "'> <i class='mdi mdi-tune'></i> </button>
                <a href='{$link}'><button type='button' class='btn btn-sm btn-dark rounded-pill btn-icon' data-bs-toggle='modal' > <i class='mdi mdi-pencil-outline'></i> </button><a/>";

                $status = " <label class='switch switch-success'>
                                <input type='checkbox' data-id='$id' data-status='{$record->status}' data-on='ACTIVE' data-value='1' data-off='INACTIVE'
                                    class='switch-input status' {$checked} />
                                <span class='switch-toggle-slider'>
                                    <span class='switch-on'></span>
                                    <span class='switch-off'></span>
                                </span>
                                <span class='switch-label'>{$record->status}</span>
                            </label>";

			$button = "<a href='" . base_url() . "abc_info/edit/" . $record->id . "' class='btn btn-info btn-sm mr-2'><i class='far fa-edit'></i></a>";
			$button .= '<a class="btn btn-sm btn-danger text-light" onclick="deleteabc_info(' . $record->id . ')" href="javascript:void(0);"><i class="far fa-trash-alt"></i></a>';

			$data[] = array(
				"id" => $i++,
				"action" => $action,
				"name" => $record->name,
				"email" => $record->email,
				"mobile" => $record->mobile,
				"user_type" => $record->type,
				"status" => $status,
				"created_at" => $record->created_at,
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
