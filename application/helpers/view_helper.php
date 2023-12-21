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
