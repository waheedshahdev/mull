<?php
$server_mode = $_SERVER['HTTP_HOST'];
if($server_mode == 'localhost'){
	 $db_host = 'localhost';
	 $db_user = 'root';
	 $db_pass = '';
	 $db_name = 'riding_software';
	 $base_url  = 'http://'.$_SERVER['HTTP_HOST'].'/mul/';
}else{
	$db_host = 'localhost';
	$db_user = 'babyshop_mul';
	$db_pass = 'E)yfIBsGu5n;';
	$db_name = 'babyshop_mul';
	$base_url  = 'http://'.$_SERVER['HTTP_HOST'].'/mul/';
}
// Define Encryption Key
define('ENC_KEY', 'JRpwEwIlco2ErI06ikI4FJDf9RlijG8E');

define('SERVER', 		$db_host);
define('DB_USER', 		$db_user);
define('DB_PASS', 		$db_pass);
define('DB_NAME',    	$db_name);
// Define Site Key
define('SITE_KEY', 		           'X&3@%~3!Nx');
// Define APP Name
define('APP_NAME',                 'Thanks,<br> ALS Team.');
// APP
define('APP',                 'ALS app');
// Define From email
define('FROM_EMIAL',               'waheedshah340@gmail.com');

// Define Root Path
//define('DOC_ROOT',      		    $_SERVER['DOCUMENT_ROOT'].'/');
// Base URL
define('BASE_URL',                  $base_url);
// Uploads Direcotry
//define('UPLOADS',      			    BASE_URL.'uploads/');
// Profile Picture
define('PP', BASE_URL.'uploads/profile_pictures/');

// Image size
define('THUMB_HEIGHT',               179);
define('THUMB_WEIGHT',               179);

// File Diretory strcture
define('FD', 'modules');
// Include directory
define('INC', 'includes');
// Routes Directory
define('ROUTES', 'routes');
// Directory Separator
define('DS', '/');

// Site Configuration constants
//config custom values
define('admin_email',         'support@als.com.my');


define('email_from',       'support@als.com.my');
define('email_from_name',  'ALIA');
define('alpha_email',      'support@als.com.my');

//Mail Configurations Custom settings
define('email_style', 'font-family: Georgia; font-size: 15px;');
define('email_footer',      '<div style="font-family: Georgia; font-size: 15px;">Regards,<br/>ALIA</style>');




?>