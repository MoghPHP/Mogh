<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/MoghPHP/Mogh
*/


return array(
	/*
	* Default title of page
	*/
	'APPLICATION_NAME'		=> 'Mogh PHP Framework',
	/*
	* 
	*/
	'BASE_URL' 				=> 'http://'.$_SERVER['HTTP_HOST'] . '/Mogh/public_html/',
	/*
	*	Database Configuration
	*	PDO Sql Server 	=> sqlsrv
	*	PDO MySql 		=> mysql
	*/
	'DBConfig'				=>  array(
									'MOGH_DB' => array(
										"DB_DRIVER" => "mysql",
										"DB_HOST" 	=> "localhost",
										"DB_PORT" 	=> "3306",
										"DB_NAME" 	=> "Mogh",
										"DB_USER" 	=> "root",
										"DB_PASS" 	=> ""
								)
	),

	/*
	* Directory path for controller files
	*/
	'CONTROLLER_PATH'		=> APPLICATION_PATH .'controllers',

	/*
	* Directory path for view files
	*/
	'VIEW_PATH'				=> APPLICATION_PATH .'views',

	/*
	* Extension for controller file
	*/
	'CONTROLLER_FILE_EXTENSION'	=> '.php',

	/*
	* Extension for controller file
	*/
	'VIEW_FILE_EXTENSION'	=> '.php',

	/*
	* Example 
	* Url 			: localhost/Home/Index
	* Controller 	: HomeController 
	*/
	'CONTROLLER_PREFIX'		=> 'Controller',

	/*
	* Example 
	* Url 			: localhost/Home/Index
	* Action 		: IndexAction 
	*/
	'ACTION_PREFIX'			=> 'Action'
);


