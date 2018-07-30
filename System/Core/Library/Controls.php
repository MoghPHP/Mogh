<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/MoghPHP/Mogh
*/

if(!function_exists('TextFor'))
{
	function TextFor($name,$value=null,$attributes ='')
	{
		echo '<input type="text" name="'. $name .'" ' . $attributes . ' value="'. (isset($value)  ? $value : (isset($_POST[$name]) ? $_POST[$name] : '')) .'" />' ;
	}
}

if(!function_exists('TextAreaFor'))
{
	function TextAreaFor($name,$value=null,$attributes ='')
	{
		echo '<textarea name="'. $name .'" ' . $attributes . '>'. (isset($value) ? $value : (isset($_POST[$name]) ? $_POST[$name] :   '')) .'</textarea>' ;
	}
}
if(!function_exists('PasswordFor'))
{
	function PasswordFor($name,$value=null,$attributes ='')
	{
		echo '<input type="password" name="'. $name .'" ' . $attributes . ' value="'. (isset($value) ? $value :(isset($_POST[$name]) ? $_POST[$name] :  '')) .'" />' ;
	}
}
if(!function_exists('EmailFor'))
{
	function EmailFor($name,$value=null,$attributes ='')
	{
		echo '<input type="email" name="'. $name .'" ' . $attributes . ' value="'. (isset($value)  ? $value : (isset($_POST[$name]) ? $_POST[$name] : '')) .'" />' ;
	}
}
if(!function_exists('DropDownListFor'))
{
	function DropDownListFor($name,$value=null,$data,$valuefield,$textfield,$attributes ='')
	{
		echo '<select name="'. $name .'" '. $attributes .'>';
		foreach ($data as $key => $val) {
			# code...
			if(HTTP_POST)
			{
				if($_POST[$name] == $val[$valuefield])
				{
					echo '<option value="'. $val[$valuefield] .'" selected>'. $val[$textfield] .'</option>';
				}else
				{
					echo '<option value="'. $val[$valuefield] .'">'. $val[$textfield] .'</option>';
				}
			}elseif(isset($value))
			{
				if($value == $val[$valuefield])
				{
					echo '<option value="'. $val[$valuefield] .'" selected>'. $val[$textfield] .'</option>';
				}else
				{
					echo '<option value="'. $val[$valuefield] .'">'. $val[$textfield] .'</option>';
				}
			}else
			{
				echo '<option value="'. $val[$valuefield] .'">'. $val[$textfield] .'</option>';
			}
		}
		echo '</select>';
	}
}
if(!function_exists('RadioButtonListFor'))
{
	function RadioButtonListFor($name,$value=null,$data,$valuefield,$textfield,$repeatdirection='vertical',$attributes ='')
	{
		foreach ($data as $key => $val) {
			# code...
			if(HTTP_POST)
			{
				if($_POST[$name] == $val[$valuefield])
				{
					echo '<input type="radio" name="'. $name .'" value="'. $val[$valuefield] .'" checked="checked" /> '. $val[$textfield] ;

				}else
				{
					echo '<input type="radio" name="'. $name .'" value="'. $val[$valuefield] .'" /> '. $val[$textfield];
				}
			}elseif(isset($value))
			{
				if($value == $val[$valuefield])
				{
					echo '<input type="radio" name="'. $name .'" value="'. $val[$valuefield] .'" checked="checked" /> '. $val[$textfield] ;
				}else
				{
					echo '<input type="radio" name="'. $name .'" value="'. $val[$valuefield] .'" /> '. $val[$textfield] ;
				}
			}else
			{
				echo '<input type="radio" name="'. $name .'" value="'. $val[$valuefield] .'" /> '. $val[$textfield] ;
			}
			echo (strtolower($repeatdirection) == 'vertical' ? '<br />' : '');
		}
	}
}