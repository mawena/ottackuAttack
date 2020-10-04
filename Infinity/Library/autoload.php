<?php
function autoload($class){
    require '../Infinity/'.str_replace('\\', '/', $class).'.class.php';
}
spl_autoload_register('autoload');