<?php
function autoload($className) {
 $file = '../' . str_replace('\\', '/', $className) . '.php';

 require $file;
}

spl_autoload_register('autoload');
/*Code Sourced from JokeSite by Tom Butler */
?>