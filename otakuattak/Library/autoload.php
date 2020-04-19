<?php
function autoload($class){
    require '../'.str_replace('\\', '/', $class).'.class.php';
}
spl_autoload_register('autoload');