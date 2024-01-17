<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('div_alert_error')) {
	/**
	 * @param $flashdata_key
	 * @return void
	 */
	function div_alert_error($flashdata_key): void
	{
		$CI =& get_instance();
		
		if (isset($CI->session)) {
			if ($CI->session->has_userdata($flashdata_key)) {
				echo '<div class="alert alert-danger" role="alert">'.
						view_flashdata($flashdata_key).
						'</div>';
				
			}
		}
		
	}
}

if ( ! function_exists('div_alert_info')) {
	/**
	 * @param $flashdata_key
	 * @return void
	 */
	function div_alert_info($flashdata_key): void
	{
		$CI =& get_instance();
		
		if (isset($CI->session)) {
			if ($CI->session->has_userdata($flashdata_key)) {
				echo '<div class="alert alert-info" role="alert">'.
						view_flashdata($flashdata_key).
						'</div>';
				
			}
		}
		
	}
}

if ( ! function_exists('upload_handler')) {
	/**
	 * @param $obj_upload
	 * @param $config
	 * @param $role_data
	 * @param $field_name
	 * @return string name of uploaded file
	 */
	function upload_handler($obj_upload, $config, $role_data, $field_name): string
	{
		/**
		 * @var CI_Upload $obj_upload
		 */
		
		$CI =& get_instance();
		$obj_upload->initialize($config);
		
		if ( ! $obj_upload->do_upload($field_name)) {
			$message['error'] = $obj_upload->display_errors();
			$html['hasil'] = $CI->load
					->view($role_data['content'], $message, true);
			
			$CI->load->view($role_data['sidebar'], $html);
		}
		
		$uploaded_image = $obj_upload->data();
		
		return $uploaded_image['file_name'];
	}
}

if ( ! function_exists('peminjam_result_dropdown')) {
	function peminjam_result_dropdown($href = '', $data = null): string
	{
		return '<li><a class="dropdown-item d-flex" href="'.$href.'">'
				.'<div class="col text-center">'.$data->name.'</div>'
				.'<div class="col text-center">'.$data->id.'</div>'
				.'<div class="col text-center">'.$data->phone.'</div>'
				.'<div class="col text-center">'.$data->role.'</div>'
				.'</a></li>';
	}
}

if ( ! function_exists('peminjam_head_dropdown')) {
	function peminjam_head_dropdown(): string
	{
		return '<li class="d-flex">'
				.'<div class="col text-center">Nama</div>'
				.'<div class="col text-center">NIM/NIK</div>'
				.'<div class="col text-center">Telpon</div>'
				.'<div class="col text-center">Status</div>'
				.'<li class="dropdown-divider">'.
				'</li>';
	}
}

if ( ! function_exists('room_result_dropdown')) {
	function room_result_dropdown($href = '', $data = null): string
	{
		return '<li><a class="dropdown-item d-flex" href="'.$href.'">'
				.'<div class="col">'.$data->name.'</div>'
				.'</a></li>';
	}
}

if ( ! function_exists('default_result_dropdown')) {
	function default_result_dropdown($data = ''): string
	{
		return '<li><div class="dropdown-item disabled">'.$data.'</div></li>';
	}
}
