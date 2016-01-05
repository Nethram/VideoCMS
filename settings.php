<?php
	include("db/db.php");
	
	$s3_upload="";
	$h720p="";
	$h360p="";
	$h240p="";

	if(isset($_POST["s3_upload"]))
	{
		$s3_upload=1;
	}
	
	
	if(isset($_POST["720p"]))
	{
		$h720p=1;
	}
	if(isset($_POST["360p"]))
	{
		$h360p=1;
	}
	if(isset($_POST["240p"]))
	{
		$h240p=1;
	}

	$query="";
	$check=mysql_query("select id,count(id) from settings ");
	$row=mysql_fetch_row($check);
	if($row[1]==0)
	{
		$query="insert into settings values(null,'$s3_upload','$h720p','$h360p','$h240p') ";
	}
	else
	{
		$query="update settings set s3_upload='$s3_upload',720p='$h720p',360p='$h360p',240p='$h240p' where id='$row[0]'";
	}
	if(mysql_query($query))
	{
		echo "1";
	}
	else
	{
		echo "0";
	}
	
?>