<!-- This form allows users to submit questions.-->
<h2>Contact Us</h2>
<h3>Enter your details below:</h3>

<form action="" method="POST" style="height: 500px;">
    <!--hidden since the user is not required to view the ID.
        But if the hiddens are left out, the form won't post since there will be missing data. The ID is set to increase automatically.-->
    <input type= "hidden" name= "inquiries[id]" value="<?=$inquiries['id'] ?? ''?>"/>
    <!--finished is concealed as, at the time of submission, the client does not need to view this.
        Since the user's inquiry has not yet been finished, this is submitted as 0 to guarantee that it is put to the appropriate admin list.
 -->
    <input type = "hidden" name="inquiries[completed]" value= 0 />
    <label>Name: </label><input type = "text" name="inquiries[name]" value="<?=$inquiries['name'] ?? ''?>" required />
    <label>Email: </label> <input type="text" name = "inquiries[email]" value="<?=$inquiries['email'] ?? ''?>"required />
	<label>Telephone: </label> <input type="text" name = "inquiries[telephone]" value="<?=$inquiries['telephone'] ?? ''?>" required/>
	<label>Inquiry: </label><textarea name = "inquiries[inquiry]" value="<?=$inquiries['inquiry'] ?? ''?>" required> </textarea>

    <input type= "submit" name = "submit" value = "Save" />
    
</form>
