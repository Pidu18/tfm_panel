<div class="ch_pass">
	<article><font class="ch_passt">Change Password</font></article>
    <form method="POST" action="inc/change_pw/pw_c_js.php">
    	<font class="ch_pass2"><?php if (isset($_GET['s'])){ echo $_GET['s']. " ".$_SESSION['a'];}else{ echo '';}?></font><br>
         <input type="password" name="v_pw" placeholder="Old Password" required><br>
         <input type="password" name="v_pw2" placeholder="Old Password x2" required><br><br>
         <input type="password" name="n_pw" placeholder="New Password(minim 6/max 32)" min="3" max="32" required><br>
         <input type="submit" name="submit" value="Change">
    </form>
</div>