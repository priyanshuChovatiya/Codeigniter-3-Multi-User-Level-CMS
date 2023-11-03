<?php
defined('BASEPATH') or exit('No direct script access allowed');

function ci()
{
	$CI =& get_instance();
	return $CI;
}
function pre($data)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}
function console_log($data)
{
	echo "<script>
          console.log('$data')
		  </script>";
}
function is_active($url)
{
	$CI =& get_instance();
	if ($CI->uri->uri_string() == $url) {
		return "active";
	}
	return "";
}
function is_open($url)
{
	$CI =& get_instance();
	if (in_array($CI->uri->uri_string(), $url)) {
		return "open";
	}
	return "";
}
function flash_message($class, $msg = null, $url = null)
{
	$CI =& get_instance();
	if (is_array($class)) {
		$msg = ['class' => $class['class'], 'message' => $class['message']];
		return $CI->session->set_flashdata('flash', $msg);
	}
	$msg = ['class' => $class, 'message' => $msg];
	$CI->session->set_flashdata('flash', $msg);

	if (!is_null($url)) {
		return redirect(base_url($url));
	}
}
function isExistsInArray($array, $key, $val)
{
	foreach ($array as $item) {
		if (isset($item[$key]) && $item[$key] == $val) {
			return true;
		}
	}
	return false;
}

function compareDates($date1, $date2)
{
	return strtotime($date1['date']) - strtotime($date2['date']);
}
function access_level_admin()
{
	
	$CI =& get_instance();
	if (!$CI->session->has_userdata('login')) {
		$message = ['class' => 'danger', 'message' => 'Your Session hase been Expired!! '];
		flash_message($message);
		redirect(base_url('/login'));
	}
}

function imageUpload($field_name, $upload_path,$file_name = NULL)
    {
        $CI =& get_instance();
        $CI->load->library('upload');

        // Configure upload options
        $config['upload_path'] = "assets/uploads/$upload_path";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000'; // 2MB
        // $config['max_width'] = '1024';
        // $config['max_height'] = '768';
        
        if ($file_name !== NULL) {
            $config['file_name'] = $file_name;
        } else {
            $config['encrypt_name'] = TRUE;
        }
        $CI->upload->initialize($config);

        if ( ! $CI->upload->do_upload($field_name))
        {
            return false;
        }
        else
        {
            return $CI->upload->data();
        }
    }
