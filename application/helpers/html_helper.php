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
