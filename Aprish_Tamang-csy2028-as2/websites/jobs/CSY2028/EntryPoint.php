<?php
namespace CSY2028;
class EntryPoint {
 private $routes;
 public function __construct(\CSY2028\Routes $routes) {
 $this->routes = $routes;
 }
 public function run() {
 $route = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');
 
 $this->routes->checkLogin($route);
 if ($route == '') {
    $route = $this->routes->getDefaultRoute();
 }
 
 list($controllerName, $functionName) = explode('/', $route);

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $functionName = $functionName . 'Submit';
 }

 $controller = $this->routes->getController($controllerName);
 $page = $controller->$functionName();

 $content = $this->loadTemplate('../templates/' . $page['template'], $page['variables']);
 $title = $page['title'];
 $class = $page['class'];
 require '../templates/layout.html.php';
 }
 
 public function loadTemplate($fileName, $templateVars) {
 extract($templateVars);
 ob_start();
 require $fileName;
 $contents = ob_get_clean();
 return $contents;

 /*The only thing need to modify would be the need for the layout, as it is the index page layout that is used on every page. This is a generic page that can be reused on other sites to generate the pages without the index.
*/
 }
}
?>
