<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/MoghPHP/Mogh
*/

if(!function_exists('UrlFor'))
{
	function UrlFor($value = null,$return = false)
	{
		if(!$return)
		{
			echo config::get('BASE_URL') ;
			echo $value;
		}else{
			return config::get('BASE_URL') . $value;
		}
	}

}

if(!function_exists('ToArray'))
{
	function toArray($data)
	{
		return !isset($data) ? [] : json_decode(json_encode($data),true);
	}
}
if(!function_exists('Any'))
{
	function Any($data)
	{
		return count($data) > 0;
	}
}
if(!function_exists('ToBytes'))
{
	function ToBytes($data)
	{
		$temp = unpack('H*', $data);
		return strtoupper(array_shift($temp));
	}
}
if(!function_exists('get_func_argNames'))
{
	function get_func_argNames($name) {
	    $f = new ReflectionFunction($name);
	    $result = array();
	    foreach ($f->getParameters() as $param) {
	        $result[] = $param->name;   
	    }
	    return $result;
	}
}
