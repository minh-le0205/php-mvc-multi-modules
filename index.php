<?php

require_once 'define.php';
function autoLoad($className) //Custom autoload name function 
{
  require_once LIBRARY_PATH . "{$className}.php";
}

spl_autoload_register('autoLoad'); // call that autoload function

$bootstrap = new Bootstrap();