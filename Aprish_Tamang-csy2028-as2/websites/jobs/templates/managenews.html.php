<?php
//subnav
require 'leftsectionadmin.html.php';
?>
<section class="right">
    <h2>Manage News</h2>
    <p>All the News Articles are listed here.</p>
    <!--The news link is placed before the records so that the administrator can find it with ease. 
-->
    <p><a href ="/news/editaddnews">Add a new News Article</a></p>

    <?php
    //Every news record that can be located in the database is shown in the table as a row.

    foreach ($news as $newsarticle) {
        echo '<table>';
		echo '<li>';
        echo '<tr>';
	 	echo '<td><div class="details">';
		echo '<h4>Title: ' . $newsarticle['title'] . '</h4>';
        echo '<h4>Content: ' . $newsarticle['content'] . '</h4>';
        echo '<h4>Date Posted: ' . $newsarticle['dateposted'] . '</h4>';
        echo '<h4>Author: ' . $newsarticle['author'] . '</h4></td>';
        //Every record has an edit button that creates a unique record page based on the news ID in the link.

        echo '<td><p><a href = "/news/editaddnews?id=' .$newsarticle['id'] . '">Edit News Article</a></p></td>';
        //When a link with the delete feature is clicked, the article is immediately deleted rather than opening on a new page.

        echo '<td><form method = "post" action = "/news/deletenewsarticle">
        <input type = "hidden" name = "id" value = "' . $newsarticle['id'] . '"/>
        <input type = "submit" name = "submit" value= "Delete this Article" />
        </form></td>';
		echo '</div>';
        echo '</tr>';
	 	echo '</li>';
        echo '</table>';
	 }
     /*The user receives a notification if no news article records are identified, giving them a concrete cue to look at rather than being puzzled by a blank page.
*/
    if(!$news) {
    ?>
    <p>There are currently no News Articles in the database.</p>
    <?php
    }
    ?>
</section>