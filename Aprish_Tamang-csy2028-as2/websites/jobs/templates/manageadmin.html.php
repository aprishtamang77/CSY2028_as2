<?php
//makes use of the admin subnavigation bar to enable easy access to the admin menu for the user.

require 'leftsectionadmin.html.php';
?>
<section class="right">
    <h2>Manage Admins</h2>
    <p>Please do not leave this screen on display as non-admins can change passwords</p>
    <!--The admin can quickly find the Add Admin link, which appears before the records.
 -->
    <p><a href ="/admins/editaddadmin">Add a New Admin</a></p>

    <?php
    //Every admin record that can be located in the database is shown in the table as a row.

    foreach ($admins as $admin) {
        echo '<table>';
		echo '<li>';
        echo '<tr>';
	 	echo '<td><div class="details">';
		echo '<h4> Username: ' . $admin['username'] . '</h4>';
        //Every record has an edit button that creates a unique record page using the admin ID from the link.

        echo '<td><p><a href ="/admins/editaddadmin?id=' .$admin['id'] .'">Edit This Admin</a></p></td>';
        //When a link with the delete option is clicked, the admin is immediately deleted rather than being sent to a new page.

        echo '<td><form method = "post" action = "/admins/deleteadmin">
        <input type = "hidden" name = "id" value = "' . $admin['id'] . '"/>
        <input type = "submit" name = "submit" value= "Delete Admin" />
        </form></td>';
        echo '</tr>';
		echo '</div>';
	 	echo '</li>';
        echo '</table>';
	 }

    /*The user receives a notification if no admin records are located, giving them a tangible prompt to check rather than being left perplexed by a blank page.
*/
    if(!$admins) {
    ?>
    <p>There are currently no Admins in the database, Please Add a Admin or Contact Support.</p>
    <?php
    }
    ?>
</section>;