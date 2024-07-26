<?php
//makes use of the admin subnavigation bar to enable easy access to the admin menu for the user.
require 'leftsectionadmin.html.php';
?>

<section class = "right" style="height: 300px;">
    <h2> Edit or Add a News Article</h2>

    <!--enctype must be supplied since this form saves pictures.-->
    <form action="" method="POST" enctype="multipart/form-data">
        <!--hidden since the user is not required to view the ID.
        But if the hiddens are left out, the form won't post since there will be missing data. The ID is set to increase automatically.

-->
        <input type= "hidden" name= "news[id]" value="<?=$news['id'] ?? ''?>"/>
        <label>Title: </label><input type = "text" name="news[title]" value="<?=$news['title'] ?? ''?>"required/>
        <label>Content: </label><input type = "text" name="news[content]" value="<?=$news['content'] ?? ''?>"required/>
      
        <!-- Should a file exist with the identical name as the news item ID, it will be replicated as the image of the automobile.

-->
        <?php
        if (isset($newsarticle) && file_exists('images/articles' . $news['id'] . '.jpg')) 
        {
            echo '<img src="images/articles' . $news['id'] . '.jpg/>';
        }
        ?>
        <label>Article Image: </label>

        <input type="file" name="image" />
        <input type= "hidden" name= "news[author]" value="<?=$_SESSION['username']?>"/>
        <input type= "submit" name = "submit" value = "Add Post" />
    </form>
</section>