<?php

	//Configure Database

	$hostname="localhost";		//Your Host
	$username="root";			//Username for database
	$password="";				//Password for database


	//$dbname = "vms_nethram";
	//$conn = mysqli_connect($hostname, $username, $password, $dbname);
	$conn = mysql_connect($hostname,$username,$password);
	mysql_select_db("vms_nethram");

	if (!$conn) {
	    die("Connection failed: ");
    }
	//Configure Amazaon S3
	
	//$bucket = 'videos_uploads/hion';	//Your Bucket Name
	$bucket = 'vms-nethram';	//Your Bucket Name
	$key='';		//Your Key
	$secret='';		//Your Secret Key



?>