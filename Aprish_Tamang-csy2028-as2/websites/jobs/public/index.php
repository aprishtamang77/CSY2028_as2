<?php
require '../autoload.php';


$routes = new \load\Routes();
$entryPoint = new \CSY2028\EntryPoint($routes);
$entryPoint->run();

/* Single point entry is provided on this page, which calls the routes and entry point and enhances page security.
 */
?>
