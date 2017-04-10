<?php

$mtime = explode(" ", microtime()); 
define('APP_START_TIME', $mtime[1] + $mtime[0]);
define('APIPATH', __DIR__.'/../App/');
date_default_timezone_set('Europe/Istanbul');
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../system/bootstrap.php';