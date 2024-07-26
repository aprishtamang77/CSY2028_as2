<?php
//calls the admin sub navigation bar so the user can go back to the admin menu easily
require 'leftsectionadmin.html.php';
?>
<section class="right">
    <h2>Manage Careers</h2>
    <p>All the job listings currently on the jobsCareers page are shown here.</p>
    <!--The jobs link is placed before the records so that the administrator can find it with ease.
 -->
    <p><a href ="/jobs/editaddjobs">Add a New Job</a></p>

    <?php
     //Every employment record that can be located in the database is shown in the table as a row.

    foreach ($jobs as $job) {
        echo '<table>';
		echo '<li>';
        echo '<tr>';
	 	echo '<td><div class="details">';
		echo '<h4> Job Title: ' . $job['title'] . '</h4>';
		echo '<p> Job Description: ' . $job['description'] . '</p>';
        echo '<p> Salary: ' . $job['salary'] . '</p></td>';
        echo '<p> Qualifications: ' . $job['qualifications'] . '</p></td>';
         //Every record has an edit button that creates a unique record page based on the job ID in the link.

        echo '<td><p><a href ="/jobs/editaddjobs?id=' .$job['id'] . '">Edit This Job</a></p></td>';
        //When a link with the delete feature is clicked, it immediately deletes the content rather than opening a new page.

        echo '<td><form method = "post" action = "/jobs/deletejobposting">
        <input type = "hidden" name = "id" value = "' . $job['id'] . '"/>
        <input type = "submit" name = "submit" value= "Delete This Job Post" />
        </form></td>';
		echo '</div>';
        echo '</tr>';
	 	echo '</li>';
        echo '</table>';
	 }
     /*The user receives a notice if no employment records are located, giving them a tangible reminder to check rather than being puzzled by a blank page.
*/
    if(!$jobs) {
    ?>
    <p>There are currently no Jobs in the database, Please add a Job or contact support.</p>
    <?php
    }
    ?>
</section>