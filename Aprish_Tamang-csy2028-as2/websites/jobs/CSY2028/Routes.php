<?php
namespace CSY2028;
interface Routes {
    public function getController($name);
    public function getDefaultRoute();
    public function checkLogin($route);
}
/*Reusable generic function that may be integrated with the entrance point and utilised on many websites
 */
?>