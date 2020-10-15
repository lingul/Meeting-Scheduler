<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'poll',
		'password' => 'poll',
		'database' => 'poll'
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_exiry' => 604800
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
	),
	'menu' => array(
		'home' => 'index.php',
		'createEvent' => 'createEvent.php',
		'login' => 'login.php',
		'logout' => 'logout.php',
		'register' => 'sign.php'
	)
);


spl_autoload_register(function ($class) {
	require_once(dirname(__DIR__) . '/classes/' . $class . '.php');
});
DB::getInstance();
require_once 'functions/sanitize.php';
