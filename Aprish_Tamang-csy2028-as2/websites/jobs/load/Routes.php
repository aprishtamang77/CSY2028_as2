<?php
	namespace load;
	class Routes implements \CSY2028\Routes {
    	public function getController($name) {

			//Getting the database connection
    		require '../databasejoin.php';

			//putting name spaces on the database tables and linking them to a variable

			$inquiriesconnect = new \CSY2028\DatabaseTable($pdo, 'inquiries', 'id');
			$jobsconnect = new \CSY2028\DatabaseTable($pdo, 'jobs', 'id');
			$adminsconnect = new \CSY2028\DatabaseTable($pdo, 'admins', 'id');
			$newsconnect = new \CSY2028\DatabaseTable($pdo, 'news', 'id');
		
			//building a controller for every table and starting a fresh database instance inside of each controller

			//namesapces applied
	
			$controllers = [];
			$controllers['inquiries'] = new \load\controllers\Inquiries($inquiriesconnect);
			$controllers['jobs'] = new \load\controllers\Jobs($jobsconnect);
			$controllers['admins'] = new \load\controllers\Login($adminsconnect);
			$controllers['news'] = new \load\controllers\News($newsconnect);
			

		return $controllers[$name];

	}	

	/*The user will be routed to news/news in the event that a route cannot be determined.The original index's route is this one. To make it more clear what is on that page, the name has been changed to news/news. News is the controller, and news is the main page that shows the news stories.er
 */
	public function getDefaultRoute() {
    	return 'news/news';
	}
 
	/* It is possible to prevent unauthorised users from accessing admin pages by using this feature, which sends them back to the login page. 
*/
 	public function checkLogin($route) {
 	session_start();
 	$loginRoutes = [];

	$loginRoutes['admins/manageadmins'] = true;
	$loginRoutes['admins/editaddadmin'] = true;
	$loginRoutes['admins/deleteadmin'] = true;

	$loginRoutes['jobs/managecareers'] = true;
	$loginRoutes['jobs/editaddjobs'] = true;
	$loginRoutes['jobs/deletejobs'] = true;

	$loginRoutes['inquiries/manageinquiries'] = true;
	$loginRoutes['inquiries/completeinquiries'] = true;
	$loginRoutes['inquiries/completedinquiries'] = true;

	$loginRoutes['news/managenews'] = true;
	$loginRoutes['news/editaddnews'] = true;
	$loginRoutes['news/deletenews'] = true;

	
	$requiresLogin = $loginRoutes[$route] ?? false;

 		if ($requiresLogin && !isset($_SESSION['loggedin'])) {
    		header('location: /admins/login');
    		exit();  
 		}  
 	}  
} 
?>