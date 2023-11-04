<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
	}

	public function redirect_if_authenticated()
    {

        switch ($this->session->userdata('login')['user_type']) {
            case 'ADMIN':
				$redirectUrl = 'admin/dashboard';
				break;
			case 'VENDOR':
				$redirectUrl = 'vendor/dashboard';
				break;
			case 'WORKER':
				$redirectUrl = 'worker/dashboard';
				break;
			case 'CUSTOMER':
				$redirectUrl = 'customer/dashboard';
				break;
			default:
				$redirectUrl = 'login';
				break;
        }
        $response = [
            'success' => 0,
            'message' => "You are already logged in !"
        ];
		$this->session->set_flashdata('flash', $response);
		return redirect(base_url($redirectUrl));

    }

	public function index()
	{
		if ($this->session->has_userdata('login')) {
			$this->redirect_if_authenticated();
		}
		return $this->load->view('login');
	}

	public function verify()
	{
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
		$this->form_validation->set_rules('password', 'Password ', 'trim|required');
		$login_user = [
			'mobile' => $this->input->post("mobile"),
			'password' => sha1($this->input->post("password"))
		];
		if ($this->form_validation->run() == true) {
			if ($this->db->get_where('user', ['mobile' => $login_user['mobile']])->num_rows() == 1) {
				if ($this->db->get_where('user', $login_user)->num_rows() == 1) {
					$user = $this->dbh->getWhereRowArray('user', $login_user);
					$loged_user = array(
						'user_id' => $user['id'],
						'mobie' => $user['mobile'],
						'username' => $user['name'],
						'user_type' => $user['type'],
						'login' => true
					);

					switch ($user['type']) {
						case 'ADMIN':
							$redirectUrl = 'admin/dashboard';
							break;
						case 'VENDOR':
							$redirectUrl = 'vendor/dashboard';
							break;
						case 'WORKER':
							$redirectUrl = 'worker/dashboard';
							break;
						case 'CUSTOMER':
							$redirectUrl = 'customer/dashboard';
							break;
						default:
							$redirectUrl = 'login';
							break;
					}

					$this->session->set_userdata('login', $loged_user);
					$message = ['success' => 1, 'message' => 'login in successfully'];
					$this->session->set_flashdata('flash', $message);
					return redirect(base_url($redirectUrl));
				} else {
					$message = ['success' => 0, 'message' => 'Enter valid Password'];
					$this->session->set_flashdata('flash', $message);
					return redirect(base_url('login'));
				}
			} else {
				$message = ['success' => 0, 'message' => 'Invalid Mobile Number'];
				$this->session->set_flashdata('flash', $message);
				return redirect(base_url('login'));
			}
		} else {
			$message = ['success' => 0, 'message' => validation_errors()];
			$this->session->set_flashdata('flash', $message);
			return redirect(base_url('login'));
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('login');
		$message = ['success' => 'success', 'message' => 'logout Successfully !'];
		$this->session->set_flashdata('flash', $message);
		redirect(base_url('login'), 'refresh');
	}
}

/* End of file Login.php */
