<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/MoghPHP/Mogh
*/

function Redirect($url, $permanent = false)
	{
	    if (headers_sent() === false)
	    {
	        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
	    }

	    exit();
}
function RedirectSelf($url, $permanent = false)
	{
	    if (headers_sent() === false)
	    {
	        header('Location: ' . BASE_URL . $url, true, ($permanent === true) ? 301 : 302);
	    }

	    exit();
}



function write($value='')
{
	echo "<pre>";
	print_r($value);
	echo "</pre>";
}