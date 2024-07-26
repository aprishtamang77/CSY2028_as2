<?php
/*When a user returns to the login page after being logged in, an admin menu and a notification informing them of their current login status are shown. By doing this, the user may avoid becoming confused and attempting to log in while they are already logged in.
 */
if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])) { 

 	require 'leftsectionadmin.html.php';
	 ?>
	<section class= "right">
    <p>You are already logged in </p> 
	</section>
 <?php
}

/*The login form is shown to the user if they are not logged in. 
*/ 
else {
    ?>
    <section class= "right">
    <h2>Log in</h2>
			<form action="" method="post">

				<label>Username</label><input type="text" name="username" required />

				<label>Password</label><input type="password" name="password" required/>

				<input type="submit" name="submit" value="Log In" />
			</form>
    </section>
<?php
}
?>

