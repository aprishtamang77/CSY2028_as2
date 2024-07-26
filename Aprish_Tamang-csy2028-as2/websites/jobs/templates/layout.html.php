<!DOCTYPE html>
<html lang = "en"> 
	<!-- This is the primary layout for every page. Values are supplied into it to make it dynamic, and instead of having repeating code, this is called whenever the primary layout is required.

 -->
	<head>
		<link rel="stylesheet" href="/styles.css"/>
		<!--This modifies the title on each page using the title value that is supplied to it. 

-->
		<title>Jo's Jobs - Home</title>
	</head
	>
	<body>
	<header>
		<section>
		<aside>
				<h3>Office Hours:</h3>
				<p>Mon-Fri: 09:00-17:30</p>
				<p>Sat: 09:00-17:00</p>
				<p>Sun: Closed</p>
			</aside>
			<h1>Jo's Jobs</h1>

		</section>
	</header>
		
	<nav>
		<ul>
			<!--Navigation menu that is displayed on each page -->
			<li><a href="/news/news">Home</a></li>
			<li><a href="/jobs/about">About Us</a></li>
			<li><a href="/inquiries/contact">Contact us</a></li>
			<li><a href="/jobs/jobscareers">Careers Advice/ jobs </a></li>
			<li><a href="/admins/login">Admin Login</a></li>

			<!--The navigation links below are only visible to logged-in users.This prevents non-admins from accessing the site's admin capabilities.

 -->
			<?php
				if(isset($_SESSION['loggedin'])) {
				echo '<li><a href="/admins/logout">Admin Logout</a></li>';
				echo  '<li><a href="/admins/adminhub">Admin Hub</a><li>';
				}?>
		</ul>
	</nav>

	<img src="/images/randombanner.php"/>

	<!--according to the value assigned in the controller, assigns the class.

 --> 
	<main class = "<?php echo $class;?> ">
    	<?php 
		//chooses the value supplied in the controller to determine the page content.
		echo $content; 
		?>
		
	</main>

	<footer>
		&copy;<?php
//this to get current date
$currentDate = date("Y-m-d");

// use the date here
echo "jo's jobs: $currentDate";
?>
	</footer>
</body>
</html>
