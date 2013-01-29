<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Site Modes
|--------------------------------------------------------------------------
|
| These modes are used for all images, js, css, links etc.
|
*/
define('HOST', 			'http://testframework/'); 			// Адрес сайта
define('HOSTADMIN',		HOST.'admin/');						// Адрес админ-панели
define('MEDIADIR', 		HOST.'media/'); 					// Дирректория js, css, images
define('MEDIAURL', 		HOST.'media/'); 					// Адрес js, css, images

//define('SHARED_DIR', 	MAIN_DIR.'shared/');
//define('SHARED_URL', 	HOST_MAIN.'shared/');
define('EDITORDIR', 	MEDIADIR.'editor/');
define('EDITORURL', 	MEDIAURL.'editor/');

define('UPLFILEDIR', 	MAINDIR.'upload/');
define('UPLFILEURL', 	HOST.'upload/');


/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */