<?php
global $ci;



function view($page_data = null)
{
	$ci = &get_instance();
	return $ci->load->view('admin/common', $page_data);
}

function getSession($session)
{
	$ci = &get_instance();
	return $ci->session->userdata($session);
}

function setSession($type, $session_data)
{
	$ci = &get_instance();
	return $ci->session->set_userdata($type, $session_data);
}

?>