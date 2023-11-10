<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaymentModel extends CI_Model
{

    public function getPayment($postData = null)
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
        $totalRecords = $this->db->select('payment.*,user.name as user_name,user.type,job_type.name as job_type')
            ->from('payment')
            ->join('user', 'user.id =payment.user_id', 'left')
			->join('job_type', 'job_type.id = payment.user_id', 'left')
            ->get()->num_rows();


        ## Total number of record with filtering
        $totalRecordwithFilter =  $this->db->select('payment.*,user.name as user_name,user.type,job_type.name as job_type')
            ->from('payment')
            ->join('user', 'user.id =payment.user_id', 'left')
			->join('job_type', 'job_type.id = payment.user_id', 'left')
            ->get()->num_rows();

        ## Fetch records
        $records =  $this->db->select('payment.*,user.name as user_name,user.type,job_type.name as job_type')
            ->from('payment')
            ->join('user', 'user.id = payment.user_id', 'left')
			->join('job_type', 'job_type.id = payment.user_id', 'left')
            ->order_by($columnName, $columnSortOrder)
            ->limit($rowperpage, $start)
            ->get()->result();

        $data = array();
        $i = $start + 1;
        foreach ($records as $record) {

            $id = $record->id;
            $link = base_url('admin/manage_payment/edit/') . $id;

			$user_type = isset($record->type) ? "( $record->type ) " : "";
			$job_type = isset($record->job_type) ? "( $record->job_type ) " : "";

			$user_name = "<span>$record->user_name  $user_type  $job_type</span>";
            $action = "<div class='d-flex gap-1'><a href='{$link}'><button type='button' class='btn btn-sm btn-dark rounded-pill btn-icon' data-bs-toggle='modal' > <i class='mdi mdi-pencil-outline'></i> </button><a/>";

            $data[] = array(
                "id" => $i++,
                "action" => $action,
                "user_name" => $user_name,
                "amount" => $record->amount,
                "date" => $record->date,
                "type" => $record->type,
                "created_at" => $record->created_at,
                "updated_at" => $record->updated_at,
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
