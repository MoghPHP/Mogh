<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/MoghPHP/Mogh
*/

class Config 
{
	 static function Configs()
	{
		return (require APPLICATION_PATH .'config/App.php');
	}
	function get($key)
	{
		return self::Configs()[$key];
	}
}