<div class="op_name">
	<?php echo $row[$usrname];?>
</div>
<div class="op_email">
	<?php $a = $row[$mail];
    if ($a == ''){
    	echo 'Email: NaN';
    }else{
    	echo 'Email: '.$row[$mail];
    }
	?>
</div>
<div class="op_marriage">
	<?php $a = $row[$marriage];
    if ($a == ''){
    	echo 'Status: Single';
    }else{
    	echo 'Status: Married with '/*<a href="index.php?mouse=' .$row[$marriage].'">'*/.$row[$marriage].'</a>'; 
    }
	?>
</div>
<div class="op_sex">
	<?php $a =  $row[$gender];
     if ($a == '0'){
     	echo 'Sex: NaN';
     }elseif($a == '1'){
     	echo 'Sex: Male';
     }elseif($a == '2'){
     	echo 'Sex: Female';
     }

	?>
</div>
<div class="op_racing">
	<font class="racing_text">Statistics</font>
	<center><table >
		<tr>
			<td>
				Firsts
			</td>
			<td>
				<?php echo $row[$FirstCount] ?>
			</td>
		</tr>
		<tr>
			<td>
				Cheese
			</td>
			<td>
				<?php echo $row[$CheeseCount] ?>
			</td>
		</tr>
		<tr>
			<td>
				Shaman Cheese
			</td>
			<td>
				<?php echo $row[$ShamanCheeses] ?>
			</td>
		</tr>
		<tr>
			<td>
				Bootcamp
			</td>
			<td>
				<?php echo $row[$BootcampCount] ?>
			</td>
		</tr>
		<tr>
			<td>
				Shaman Saves
			</td>
			<td>
				<?php echo '<font color="white">'.$row[$ShamanSaves]. '</font>/<font color="green">' .$row[$HardModeSaves]. '</font>/<font color="cyan">' .$row[$DivineModeSaves].'</font>' ?>
			</td>
		</tr>
	</table></center>
</div>