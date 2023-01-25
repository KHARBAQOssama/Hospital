<?php 
spl_autoload_register(function($class){
    $path = 'classes/'.$class.'.class.php';
    require $path;
})?>