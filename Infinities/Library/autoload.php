<?php
function autoload($class){
    require '../Infinities/'.str_replace('\\', '/', $class).'.class.php';
}
spl_autoload_register('autoload');