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
	if (!empty($content)) {
		if (!empty($name)) {
			echo $content[$name];
			return;
		}
		
		if (is_array($content)) {
			show_error('Loaded content is an array.');
			return;
		}
		
		echo $content;
		return;
	}
	
	show_error('Content name is not found.');
}
