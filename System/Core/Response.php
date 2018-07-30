<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/MoghPHP/Mogh
*/

class Response
{
	/**
	* Redirect Url Location 
	*/
	public static function Redirect($url, $permanent = false)
	{
	    if (headers_sent() === false)
	    {
	        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
	    }

	    exit();
	}

	public static function Write($arr)
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
}