<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/MoghPHP/Mogh
*/

class AutoLoader
{
	public static function LoadAll($location) 
	{ 
	   foreach (scandir($location) as $key => $value) 
	   { 
	      if (!in_array($value,array(".",".."))) 
	      { 
	         if (is_dir($location . DIRECTORY_SEPARATOR . $value)) 
	         	self::LoadAll($location . DIRECTORY_SEPARATOR . $value); 
	         else 
	         { 
				require_once($location . DIRECTORY_SEPARATOR. $value);
	         } 
	      } 
	   } 
	} 

	/**
	* Batch load all css in folder
	*/
	static function LoadCss($location)
	{			
		$files =glob($location. "/*.css");
		for($a =0;$a<count($files);$a++)
			echo '<link rel="stylesheet" type="text/css" href="' . UrlFor($files[$a]) . '">' ;
	}
	
	/**
	* Batch load all js in folder
	*/
	static function LoadJs($location)
	{			
		$files =glob($location. "/*.js");
		for($a =0;$a<count($files);$a++)
			echo '<script type="text/javascript" src="'. UrlFor($files[$a]) .'"></script>' ;
	}

}