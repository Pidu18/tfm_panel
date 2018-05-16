<div class="ch_email">
	<article><font class="ch_emailt">Change Email</font></article>
    <form method="POST" action="inc/change_email/email_c.php">
    	<font class="ch_email2"><?php if (isset($_GET['s'])){ echo $_GET['s']. " ".$_SESSION['email'];}else{ echo '';}?></font><br>
         <input type="email" name="email" placeholder="Email" required><br>
         <input type="submit" name="submit" value="Change">
    </form>
</div>