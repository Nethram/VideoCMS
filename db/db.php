<?php

	//Configure Database

	$hostname="localhost";		//Your Host
	$username="root";			//Username for database
	$password="";				//Password for database


	$conn = mysql_connect($hostname,$username,$password);
	mysql_select_db("vms_nethram");

	if (!$conn) {
	    die("Connection failed: ");
    }
	//Configure Amazaon S3
	
	
	$bucket = 'vms-nethram';	//Your Bucket Name
	$key='';		//Your Key
	$secret='';		//Your Secret Key



?>