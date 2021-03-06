<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/MoghPHP/Mogh
*/

class Input 
{
	
	/**
	* get data from POST method
	* Example : <form action='<?php SELF_ACTION;?>' method='post'><input type='text' name='user' /></form> Input::post('user'); 
	* 			will return value from input user
	*/		
	public static function post($name,$clean =false)
	{
		return  isset($_POST[$name]) ? ($clean ? Security::clean_str($_POST[$name]) : $_POST[$name]) : '';
	}	
	public static function get($name,$clean =false)
	{
		return  isset($_GET[$name]) ? ($clean ? Security::clean_str($_GET[$name]) : $_GET[$name]) : '';
	}
}