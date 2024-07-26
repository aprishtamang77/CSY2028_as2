<!--This serves as a visual cue for the user, since without it they could not know if their request was fulfilled. -->
<section class = "right">
<p style="color:green;">Updated Successfully!</p>
<?php
				if(isset($_SESSION['loggedin'])) {
				echo  '<a href="/admins/adminhub">Go back</a>';
				}?>
                <!--reidrect to the admin hub-->
</section>