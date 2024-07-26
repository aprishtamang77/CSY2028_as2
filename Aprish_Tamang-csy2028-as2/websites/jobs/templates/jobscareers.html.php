
<h1>Carrier's</h1>
<?php 
//Every job record in the job table has a display created for it using the foreach loop.


//it is used to pull out each tables attributes
foreach ($jobs as $job) {
		echo '<li>';
	 	echo '<div class="details">';
		echo '<h2>' . $job['title'] . ' ' . '</h2>';
		echo '<p>Description: ' . $job['description'] . '</p>';
		echo '<p>Salary: £' . $job['salary'] . '</p>';
		echo '<p>Qualifications Needed : ' . $job['qualifications'] . '</p>';
		echo '<a class="more" href="/inquiries/contact?id=' . $job['id'] . '">Apply for this job</a>';
		echo '</div>';
	 	echo '</li>';
	 }

//A notice explaining why there are no records will be shown to the user if no jobs are located.


if(!$jobs) {
    ?>
    <p>No any advices</p>
<?php
}
?>