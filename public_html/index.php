<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/MoghPHP/Mogh
*/

define('SYSTEM_PATH', '../System/');
define('APPLICATION_PATH', '../Application/');

/**
* Get current request method
* @return boolean
*/
define('HTTP_POST', $_SERVER['REQUEST_METHOD'] === 'POST');
define('HTTP_GET', $_SERVER['REQUEST_METHOD'] === 'GET');

/**
* Starting New Application
*/
require_once( SYSTEM_PATH .'Core/Application.php');
new Application();

