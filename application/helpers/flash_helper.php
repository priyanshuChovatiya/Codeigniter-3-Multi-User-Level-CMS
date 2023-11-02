<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class FlashRedirect
{

	protected $CI;
	protected $message;
	protected $url;
	protected $type;
	protected $session;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');
	}

	public function withSuccess($message)
	{
		$this->message = $message;
		$this->type = "alert success";
		return $this;
	}
	public function withError($message)
	{
		$this->message = $message;
		$this->type = "alert danger";
		return $this;
	}

	public function with($class, $message)
	{
		$this->message = $message;
		$this->type = $class;
		return $this;
	}

	public function to($url)
	{
		$this->url = ($url);
		return $this;
	}

	public function back()
	{
		$this->url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('admin/dashboard');
		return $this;
	}

	public function go()
	{
		$this->CI->session->set_flashdata('flash_message', array('class' => $this->type, "message" => $this->message));
		if (!empty($this->url)) {
			redirect($this->url, 'refresh');
		}
	}
}

function flash()
{
	return new FlashRedirect();
}
?>