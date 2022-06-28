<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_departments')){
    function get_departments() {
        $CI =& get_instance();
        $CI->load->model('department/Admin_model', 'Department_admin_model');
        $data = $CI->Department_admin_model->records();
        return $data;
    }
}