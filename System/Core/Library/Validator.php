<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/MoghPHP/Mogh
*/

class Validator 
{
	
	function Validate(string $key,string $type,string $ErrorMessage = null)
	{

		// Handle Custom Validation with method
		$metd = explode('::', $type);
		if(count($metd) == 2)
		{
			if (method_exists($metd[0], $metd[1])) 
			{			
				return [
					"isvalid" => call_user_func_array($type, ["key"=>$key]),
					"Message" => (isset($ErrorMessage) ? $ErrorMessage : sprintf(UIString::getMsg('VALIDATION_INVALID',APP_LANG),$key))
				];
			}
		}

		switch ($type) 
		{	
			case 'required':
				if(!isset($_POST[$key]) || $_POST[$key] =='')
				{
					return [
						"isvalid" => false,
						"Message" => (isset($ErrorMessage) ? $ErrorMessage : sprintf(UIString::getMsg('VALIDATION_REQUIRED',APP_LANG),$key))
					];
				}
				break;
			case 'alphanumeric':
				if(!ctype_alnum($_POST[$key]))
				{
					return [
						"isvalid" => false,
						"Message" => (isset($ErrorMessage) ? $ErrorMessage : sprintf(UIString::getMsg('VALIDATION_INVALID_ALPHANUMERIC',APP_LANG),$key))
					];
				}
				break;
			case (preg_match('/(Compare\()(\w+)\)/',$type,$matches) ? true : false) :
				if($_POST[$key] !=$_POST[$matches[2]]){	
					return [
						"isvalid" => false,
						"Message" => (isset($ErrorMessage) ? $ErrorMessage : sprintf(UIString::getMsg('VALIDATION_INVALID_COMPARE',APP_LANG),$key,$matches[2]))
					];
				}
				break;
			case (preg_match('/(StrLen\()(\d+)\)/',$type,$matches) ? true : false) :
				if(strlen($_POST[$key]) != (int)$matches[2]){	
					return [
						"isvalid" => false,
						"Message" => (isset($ErrorMessage) ? $ErrorMessage : sprintf(UIString::getMsg('VALIDATION_INVALID_LENGTH',APP_LANG),$key,$matches[2]))
					];
				}
				break;	
			case (preg_match('/(StrMin\()(\d+)\)/',$type,$matches) ? true : false) :
				if(strlen($_POST[$key]) < (int)$matches[2]){
					return [
						"isvalid" => false,
						"Message" => (isset($ErrorMessage) ? $ErrorMessage : sprintf(UIString::getMsg('VALIDATION_INVALID_MIN_LENGTH',APP_LANG),$key,$matches[2]))
					];
				}
				break;	
			case (preg_match('/(StrMax\()(\d+)\)/',$type,$matches) ? true : false) :
				if(strlen($_POST[$key]) > (int)$matches[2]){
					return [
						"isvalid" => false,
						"Message" => (isset($ErrorMessage) ? $ErrorMessage : sprintf(UIString::getMsg('VALIDATION_INVALID_MAX_LENGTH',APP_LANG),$key,$matches[2]))
					];
				}
				break;	
			case (preg_match('/(DataType\()(\w+)\)/',$type,$matches) ? true : false) :
				switch (strtolower($matches[2])) {
					case 'date':
						if(!(DateTime::createFromFormat('d-m-Y', $_POST[$key]) !== false)){
							return [
								"isvalid" => false,
								"Message" => (isset($ErrorMessage) ? $ErrorMessage : sprintf(UIString::getMsg('VALIDATION_INVALID_DATATYPE',APP_LANG),$key,$matches[2]))
							];
						}
						break;
					case 'email':
						if(!filter_var($_POST[$key], FILTER_VALIDATE_EMAIL)){
							return [
								"isvalid" => false,
								"Message" => (isset($ErrorMessage) ? $ErrorMessage : sprintf(UIString::getMsg('VALIDATION_INVALID_DATATYPE',APP_LANG),$key,$matches[2]))
							];
						}
						break;
					case 'int':
					case 'decimal':
					case 'float':
					case 'long':
					case 'money':
						if(!is_numeric($_POST[$key])){
							return [
								"isvalid" => false,
								"Message" => (isset($ErrorMessage) ? $ErrorMessage : sprintf(UIString::getMsg('VALIDATION_INVALID_DATATYPE',APP_LANG),$key,$matches[2]))
							];
						}
						break;
				}
				break;
			default:
				# code...
				break;
		}
		return [
			"isvalid" => true,
			"Message" => null
		];
	}
}