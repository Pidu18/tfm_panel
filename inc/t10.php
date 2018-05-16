<div class="top10">
	<article><font class="t10">Top 10</font></article>
	<center><table border="1">
		<tr>
            <td>
            	Username
            </td>
            <td>
            	Firsts
            </td>
            <td>
            	CheeseCount
            </td>
            <td>
            	Bootcamps
            </td>
		</tr>
		<tr>
			<?php
			$user = $_SESSION['nume'];
			$s = "SELECT * FROM users ORDER BY FirstCount Desc limit 10";
			$c = $con->prepare($s);
			$c->execute();
			while($row = $c->fetch(PDO::FETCH_ASSOC)){
				echo "<td>".$row[$usrname]."</td><td>".$row[$FirstCount]."</td><td>".$row[$CheeseCount]."</td><td>".$row[$BootcampCount]."</td></tr>";
			}

		    ?>
	</table></center>
</div>

