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
