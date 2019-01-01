<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


define('WEBROOT',dirname(__FILE__));
define('ROOT',dirname(WEBROOT));
define('DS',DIRECTORY_SEPARATOR);
define('CORE',ROOT.DS.'CORE');
define('BASE_URL',dirname(dirname($_SERVER['SCRIPT_NAME'])));
//define('BASE_URL', .$_SERVER['SERVER_NAME']);

require CORE.DS.'Includes.php';

new Dispatcher();

