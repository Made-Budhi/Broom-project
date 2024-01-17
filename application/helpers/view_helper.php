<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('view')) {
	/**
	 * Wrapper for view load
	 * Use this function from view controller and search the name base on
	 * passed Array key.
	 *
	 * @param string $content the array name that passed
	 * @param string $name the value of array key
	 * @return void view of passed content
	 *
	 * @example
	 *  $html['content'] = $this->load->view($view['content'], $data, true);
	 *
	 * @example
	 *  $this->load->view($view['sidebar'], $html);
	 *
	 * @example
	 * view("content");
	 */
	function view(string $content , string $name = ''): void
	{
		$CI = &get_instance();
		
		$content = $CI->load->get_var($content);
		
		if (empty($content)) {
			log_message('info', 'content is not found or empty!');
			return;
		}
		
		if (!empty($name)) {
			echo $content[$name];
			return;
		}
		
		if (is_array($content)) {
			show_error('Loaded content is an array, please provide content key');
			return;
		}
		
		echo $content;
	}
}

if ( ! function_exists('view_data')) {
	/**
	 * Used to check and find injected data from models/controller.
	 * this also allow to find specific names if needed
	 *
	 * @param $datas
	 * @param mixed ...$names
	 */
	function view_data(&$datas, ...$names): void
	{
		if (empty($datas)) {
			log_message('info', 'Data is not found or empty!');
			$datas = array();
			return;
		}
		
		if (is_array($datas) || is_object($datas) && empty($names)) {
			log_message('info', 'Name of data is not provided!');
			unset($datas);
			return;
		}
		
		$temps = $datas;
		$result = null;
		
		if (is_object($temps)) {
			foreach ($names as $name)
				$result[$name] = $temps->$name;
			
			$datas = (object)$result;
		} else if (is_array($temps)) {
			foreach ($temps as $data) {
				$is_object = is_object($data);
				
				if ($is_object) {
					foreach ($names as $name)
						$result[$name] = $data->$name;
				} else {
					foreach ($names as $name)
						$result[$name] = $data;
				}
				
				$datas[] = (object)$result;
				
				if (!$is_object) {
					break;
				}
			}
		}
	}
}


if ( ! function_exists('view_flashdata')) {
	/**
	 * Use this function if flash data really used
	 *
	 * @param $key
	 * @return string|null
	 */
	function view_flashdata($key): ?string
	{
		$CI = &get_instance();
		$CI->load->helper('html');
		
		if (isset($CI->session)) {
			$temp = $CI->session->flashdata($key);
			if (!empty($temp)) {
				return $temp;
			}
		}
		
		return null;
	}
}

if ( ! function_exists('livesearch')) {
	/**
	 * @param $searchStr
	 * @param $results
	 * @param $result_drop
	 * @param $default_drop
	 * @param $url
	 * @param $head_drop
	 * @return void
	 */
	function livesearch($searchStr, $results, $result_drop, $default_drop, $url, $head_drop): void
	{
		//lookup all links from the xml file if length of q>0
		$hint = $head_drop();
		if (strlen($searchStr) > 0) {
			foreach ($results as $data) {
				//find a link matching the search text
				$href = site_url($url.$data->id);
				$hint .= $result_drop($href, $data);
			}
		}
		
		// Set output to "no suggestion" if no hint was found
		// or to the correct values
		if (empty($results)) {
			$response = $hint.$default_drop();
		} else {
			$response = $hint;
		}
		
		//output the response
		echo $response;
	}
}
