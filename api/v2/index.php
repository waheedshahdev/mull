<?php
/*---------------------------------------------------------------------------------------
|    			Application developed by Amin Dad Shah  for ALS APP   				    |          		 							  
----------------------------------------------------------------------------------------*/
// Database Connection file
require('db/db.php'); 

// Include common functions file
require 'common.php';


/*----------------------------------------------------------------------------*
|       Include all files from modules direcotry    	                      |
|       To organize file structures added Monday, August 10, 2017             |
------------------------------------------------------------------------------*/

// Resident APIs
include_once FD . DS . 'customer/index.php';
include_once FD . DS . 'captain/index.php';

// This line is must to use Slim Framework
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

// Response should be json
$app->contentType('application/json');

// GET CI Application Invironment
function get_ci_app_env(){
   $CI = require_once 'index.php';
  return $CI;	
}

function index(){
	$ci = get_ci_app_env();
	echo json_encode(array('status' => true,
	                       'message' => 'Welcome to the app',print_r($ci),
	                       ));
}

$app->get('/', 'index'); 
// All api calls routes
require ROUTES . DS .'api_routes.php';
$app->run();








