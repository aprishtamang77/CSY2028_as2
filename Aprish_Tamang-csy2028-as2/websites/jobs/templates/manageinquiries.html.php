<?php
//subnav
require 'leftsectionadmin.html.php';
?>
<section class="right">
    <h2>Manage Inquiries</h2>
    <p>All the Customer inquiries are listed here.</p>

    <?php
     //Every inquiry record that can be located in the database is shown in the table as a row.

    foreach ($inquiries as $inquiry) {
        echo '<table>';
		echo '<li>';
        echo '<tr>';
	 	echo '<td><div class="details">';
		echo '<h4> Customer Name: ' . $inquiry['name'] . '</h4>';
		echo '<p> Customer Email: ' . $inquiry['email'] . '</p>';
        echo '<p> Customer Telephone: ' . $inquiry['telephone'] . '</p>';
        echo '<p> Inquiry: ' . $inquiry['inquiry'] . '</p>';
        // When this is clicked, the inquiry's value is set to 1, marking it as finished and moving it to a new list.

        echo '<td><form method="post" action="/inquiries/completeinquiries">
        <input type="hidden" name="inquiries[id]" value="' . $inquiry['id'] . '" />
        <input type="hidden" name="inquiries[completed]" value="1" />
        <input type="submit" name="submit" value="Complete" />
        </form></td>';
		echo '</div>';
        echo '</tr>';
	 	echo '</li>';
        echo '</table>';
	 }
     
    /*The user receives a notification if no inquiry records are located, giving them a tangible reminder to check rather than being puzzled by a blank page.
*/
    if(!$inquiries) {
    ?>
    <p>There are currently no Inquiries in the database.</p>
    <?php
    }
    ?>
</section>