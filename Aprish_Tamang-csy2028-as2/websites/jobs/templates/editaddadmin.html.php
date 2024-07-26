<?php
//makes use of the admin subnavigation bar to enable easy access to the admin menu for the user.

require 'leftsectionadmin.html.php';
?>

<section class = "right">
    <h2> Update or Add a Admin</h2>

    <form action="" method="POST" style="height: 300px;">
         <!-- hidden since the user is not required to view the ID.
        But if the hiddens are left out, the form won't post since there will be missing data. The ID is set to increase automatically.
-->
        <input type= "hidden" name= "admins[id]" value="<?=$admins['id'] ?? ''?>"/>
        <label>Name: </label><input type = "text" name="admins[username]" value="<?=$admins['username'] ?? ''?>"required/>
        <label>Password: </label><input type = "password" name="admins[password]" value="<?=$admins['password'] ?? ''?>"required/>
        <input type= "submit" name = "submit" value = "Save" />
    </form>
</section>