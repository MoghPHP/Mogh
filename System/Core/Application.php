
<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/MoghPHP/Mogh
*/

require_once('AutoLoader.php');
class Application 
{
	
	function __construct()
	{
		/*
		*	WARNING! IMPORTANT! BECAREFULL!
		*
		*	this function will load all your files 
		* 	Loading All library, Config, Core & etc
		*/
		AutoLoader::LoadAll(SYSTEM_PATH);		

		set_error_handler('ErrorHandler::_error_handler');
		set_exception_handler('ErrorHandler::_exception_handler');
		register_shutdown_function('ErrorHandler::_shutdown_handler');
		
		foreach ((require APPLICATION_PATH .'config/AutoLoader.php')as $key => $value) 
		{
			AutoLoader::LoadAll($value);
		}
		/**
		* Start Routing
		* 
		*/
		Router::Execute(require APPLICATION_PATH .'config/RouteCollections.php');
	}	
}
