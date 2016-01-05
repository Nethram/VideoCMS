<?php
	include("db/db.php");
	$all_category=mysql_query("select * from categories");
	while($row=mysql_fetch_row($all_category))
	{
		echo "<option value=$row[0]>$row[1]</option>";
	}
	echo "<option value=other>Other</option>";
?>