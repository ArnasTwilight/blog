<?php
session_start();

define('ROOT', dirname(__FILE__));
define('NAME_SITE', 'Blog', false);

require_once (ROOT . '/components/autoload.php');
spl_autoload_register('my_autoload');

$router = new Router();
$router->begin();