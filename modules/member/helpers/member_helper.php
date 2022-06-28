<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('all_members')){
	function all_members()
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = (array) $CI->Member_model->all_members();
		return $data;
	}
}

if(!function_exists('get_member')){
	function get_member($id)
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = (array) $CI->Member_model->member($id);
		return $data;
	}
}

if(!function_exists('get_member_session')){
	function get_member_session($value)
	{
		global $CI;
		$CI->load->model('member/Member_model');
		$data = (array) $CI->Member_model->get_member_session($CI->session->userdata['member_logged_in']["email"]);		
		return $data[$value];
	}
}

if(!function_exists('get_city_title')){
	function get_city_title($city_id)
	{
		global $CI;
		$CI->load->model('dealers/Dealers_model');
		$data = $CI->Dealers_model->get_city_title($city_id);
		if($data != NULL){
			return $data->title;
		}else{
			return "";
		}
	}
}

if(!function_exists('get_town_title')){
	function get_town_title($town_id)
	{
		global $CI;
		$CI->load->model('dealers/Dealers_model');
		$data = $CI->Dealers_model->get_town_title($town_id);
		if($data != NULL){
			return $data->title;
		}else{
			return "";
		}
	}
}

if(!function_exists('all_cities')){
	function all_cities()
	{
		global $CI;
		$CI->load->model('dealers/Dealers_model');
		return $CI->Dealers_model->tr_city();
	}
}