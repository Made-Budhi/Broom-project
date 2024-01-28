<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/

$hook['session_login_check'][] = array(
		'class'    => 'Session_validation',
		'function' => 'check_session_log_in',
		'filename' => 'Session_validation.php',
		'filepath' => 'hooks',
);

$hook['session_logout_check'][] = array(
		'class'    => 'Session_validation',
		'function' => 'check_session_log_out',
		'filename' => 'Session_validation.php',
		'filepath' => 'hooks',
);
