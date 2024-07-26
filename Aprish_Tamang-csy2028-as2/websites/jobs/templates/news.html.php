<section class = "right">
<h2>News</h2>

<?php
    //Every article that has been located has its record shown in a table row.

    foreach($news as $newsarticle) {
        echo '<table>';
        echo '<li>';
	 	echo '<div class="details">';
		echo '<tr><h2>' . $newsarticle['title'] . '</h2></tr>';

        //When an image file with the same ID as the article is found, it is retrieved as the picture from the article.

        if (file_exists('images/articles/' . $newsarticle['id'] . '.jpg')) {
            echo '<tr><img src="/images/articles/' . $newsarticle['id'] . '.jpg" /></a></tr>';
        }
		echo '<tr><h3>' . $newsarticle['content'] . '</h3></tr>';
        echo '<tr>';
		echo '<td><p>Publish Date: ' . $newsarticle['dateposted'] . '</p></td>';
		echo '<td><p>Author: ' . $newsarticle['author'] . '</p></td>';
        echo '</tr>';
		echo '</div>';
	 	echo '</li>';
        echo '</table>';
        
    }

    //A notice explaining why the page is blank is shown to the user if there are no articles to display.

    if(!$news) {
        ?>
        <p>jo's jobs currently has no news articles.</p>
        <p>Please check soon as we frequently add articles</p>
    <?php
    }
?>
</section>