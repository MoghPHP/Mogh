<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/MoghPHP/Mogh
*/

class ErrorHandler
{
	
	function __construct()
	{		
	}

	public static function Error404()
	{
		
		self::GeneralError('Request page not found.');
		http_response_code(404);
		exit();
	}

	public static function ErrorCSRF(){

		//require VIEW_PATH .'/Error/ErrorCSRF.phtml';
		self::GeneralError('Invalid Request Token.');
		exit();
	}

	public static function Error()
	{
		exit();
	}

	public static function ControllerNotFound()
	{
		self::GeneralError('Controller File Does Not Exist.');
		exit();
	}

	public static function ActionMethodNotFound()
	{
		self::GeneralError('Action Method Does Not Exist.');
		exit();
	}

	public static function ViewNotFound($filename='')
	{
		self::GeneralError($filename . ' Does Not Exist.');
		exit();
	}
	function _error_handler($severity, $message, $filepath, $line)
	{
		$is_error = (((E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR | E_USER_ERROR) & $severity) === $severity);

		// When an error occurred, set the status header to '500 Internal Server Error'
		// to indicate to the client something went wrong.
		// they are above the error_reporting threshold.
		if ($is_error)
		{
			set_status_header(500);
		}

		// Should we ignore the error? We'll get the current error_reporting
		// level and add its bits with the severity bits to find out.
		if (($severity & error_reporting()) !== $severity)
		{
			return;
		}

		// Should we display the error?
		if (str_ireplace(array('off', 'none', 'no', 'false', 'null'), '', ini_get('display_errors')))
		{
			echo '<div style="border:solid 1px red;margin:5px;padding:10px;background-color:#FFF;">';
			echo '<h2 style="color:red;">Server Error in Application.</h2>';
			echo '<hr size="1" />';
			echo '<p style="font-size:16px;font-style:italic;">Error : ' .$message.'</p>';			
			if(isset($exception)){ 
				echo '<p style="color:red;">';
				echo '<b>File</b>    : ' . $exception->getFile(). '<br >';
				echo '<b>Line</b>    : ' . $exception->getLine() . '<br >';
				echo "</p>";
				echo "<h4>Stack Trace : </h4>";
				foreach ($exception->getTrace() as $error)
				{
					if (isset($error['file']))
					{
						echo '<p style="margin-left:10px">';
						echo 'File: ' . $error['file'] . '<br />';
						echo 'Line: ' . $error['line'] . '<br />';
						echo 'Function: ' . $error['function'];
						echo '</p>';
					}	
				}
			}	
			echo "<hr size='1' />";
			echo "<p><b>Version Information : </b>Mogh PHP Framework, Alpha Version </p>";		
			
			echo "<div>";

			exit(1);
		}

		// If the error is fatal, the execution of the script should be stopped because
		// errors can't be recovered from. Halting the script conforms with PHP's
		// default error handling. See http://www.php.net/manual/en/errorfunc.constants.php
		if ($is_error)
		{
			exit(1); 
		}
	}
	function _exception_handler($exception)
	{		
		// Should we display the error?
		if (str_ireplace(array('off', 'none', 'no', 'false', 'null'), '', ini_get('display_errors')))
		{
			echo '<div style="border:solid 1px rgba(0,0,0,0.2);margin:5px;padding:10px;background-color:#FFF;">';
			echo '<h2 style="color:red;">Server Error in Application.</h2>';
			echo '<hr size="1" />';
			echo '<p style="font-size:16px;font-style:italic;">'.get_class($exception) . ' : ' .$exception->getMessage().'</p>';
			echo '<p style="color:red;">';
			echo '<b>File</b>    : ' . $exception->getFile(). '<br >';
			echo '<b>Line</b>    : ' . $exception->getLine() . '<br >';
			echo "</p>";
			echo "<h4>Stack Trace : </h4>";
			foreach ($exception->getTrace() as $error)
			{
				if (isset($error['file']))
				{
					echo '<p style="margin-left:10px;font-size:12px;">';
					echo 'File: ' . $error['file'] . '<br />';
					echo 'Line: ' . $error['line'] . '<br />';
					echo 'Function: ' . $error['function'];
					echo '</p>';
				}	
			}
			echo "<hr size='1' />";
			echo "<p><b>Version Information : </b>Mogh PHP Framework, Alpha Version</p>";
			echo "<div>";
		}

		exit(1); 
	}
	function _shutdown_handler()
	{
		$last_error = error_get_last();
		if (isset($last_error) &&
			($last_error['type'] & (E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING)))
		{
			_error_handler($last_error['type'], $last_error['message'], $last_error['file'], $last_error['line']);
		}
	}

	function GeneralError($message='')
	{
		echo '<div style="border:solid 1px red;margin:5px;padding:10px;background-color:#FFF;">';
		echo '<h2 style="color:red;">Server Error in Application.</h2>';
		echo '<hr size="1" />';
		echo '<p style="font-size:16px;font-style:italic;font-size:12px;">Error : ' .$message.'</p>';			
		echo "<hr size='1' />";
		echo "<p><b>Version Information : </b>Mogh PHP Framework, Alpha Version</p>";			
		echo "<div>";
	}
}