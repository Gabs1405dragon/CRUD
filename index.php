<?php  
define('PATH_CRUD','http://localhost/crud_php/views/pages/');
$autoload = function($class){
    include($class.'.php');
};

spl_autoload_register($autoload);

$aplication = new Aplication();
$aplication->run();
