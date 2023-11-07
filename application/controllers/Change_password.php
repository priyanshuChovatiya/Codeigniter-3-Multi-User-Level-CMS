<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Change_password extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
		is_login();
    }

    public function index()
    {
        $page_data['page_title'] = 'Change Password';
        $page_data['page_name'] = 'change_password';
        $user_type = $this->session->userdata('login')['user_type'];
        return $this->load->view("$user_type/common", $page_data);
    }

    public function password()
    {
        $this->form_validation->set_rules('old_password', 'Old Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

        if ($this->form_validation->run() == false) {
            $message['success'] = 0;
            $message['message'] = validation_errors();
            $this->session->set_flashdata('flash', $message);
            redirect(base_url('change_password'), 'refresh');
        } else {

            $user_id = $this->session->userdata('login')['user_id'];
            $data = $this->input->post();

            $old_password = $this->db->get_where('user', array('id' => $user_id))->row('password');
            // echo   $old_password, sha1($data['old_password']);
            // exit;
            if (sha1($data['old_password']) == $old_password) {
                $update = $this->db->where('id', $user_id)->update('user', array('password' => sha1($data['new_password'])));
                if ($update) {
                    $message['success'] = 1;
                    $message['message'] = "User password change  SuccessFully.";
                    $this->session->set_flashdata('flash', $message);
                    redirect(base_url('change_password'));
                } else {
                    $message['success'] = 0;
                    $message['message'] = "Failed to changed password.";
                    $this->session->set_flashdata('flash', $message);
                    redirect(base_url('change_password'));
                }
            } else {
                $message['success'] = 0;
                $message['message'] = "Incorrect Current password.";
                $this->session->set_flashdata('flash', $message);
                redirect(base_url('change_password'));
            }
        }
    }
}
