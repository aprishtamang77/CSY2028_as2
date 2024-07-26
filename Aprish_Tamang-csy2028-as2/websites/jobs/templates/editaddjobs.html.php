<?php
//enables the user to quickly return to the admin menu by calling the admin subnavigation bar.

require 'leftsectionadmin.html.php';
?>

<section class = "right" style="height: 500px;">
    <h2> Update or Add Job Posting</h2>

    <form action="" method="POST">

        <!--hidden since the user is not required to view the ID.
        But if the hiddens are left out, the form won't post since there will be missing data. The ID is set to increase automatically.
-->
        <input type= "hidden" name= "jobs[id]" value="<?=$jobs['id'] ?? ''?>"/>
        <label>Title: </label><input type = "text" name="jobs[title]" value="<?=$jobs['title'] ?? ''?>"required/>
        <label>Description: </label><input type = "text" name="jobs[description]" value="<?=$jobs['description'] ?? ''?>"required/>
        <label>Salary: </label><input type = "text" name="jobs[salary]" value="<?=$jobs['salary'] ?? ''?>"/>
        <label>Qualifications: </label><input type = "text" name="jobs[qualifications]" value="<?=$jobs['qualifications'] ?? ''?>"required/>
        <input type= "submit" name = "submit" value = "Save" />
    </form>
</section>