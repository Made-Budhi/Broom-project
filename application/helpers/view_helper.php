<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Use this function by passing $data['content'] first
 * and search the name base on passed Array
 * @param $content
 * @param string $name
 * @return void view of passed content
 *
 */
function view(&$content , string $name = ''): void
{
	if (empty($content)) {
		show_404();
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

function view_data(&$datas, ...$names): void
{
	if (empty($datas)) {
		log_message('info', 'Data is not found or empty!');
		$datas = array();
		return;
	}
	
	if (empty($names)) {
		log_message('info', 'Name of data is not provided!');
		return;
	}
	
	$temps = $datas;
	$result = null;
	$datas = null;
	
	foreach ($temps as $data) {
		$is_object = is_object($data);
		
		if ($is_object) {
			foreach ($names as $name)
				$result[$name] = $data->$name;
		} else {
			foreach ($names as $name)
				$result[$name] = $data;
		}
		
		$datas[] = (object) $result;
		
		if (!$is_object) {
			break;
		}
	}
}
