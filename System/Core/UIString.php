<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/MoghPHP/Mogh
*/

class UIString 
{

	public static function getMsg($MID,$LID)
	{
		$Lang = (require APPLICATION_PATH .'config/UIString.php');
		return  !array_key_exists($MID,$Lang) 
				? $MID : !array_key_exists($LID,$Lang[$MID])  
				? $MID : self::$Lang[$MID][$LID];
	}
}