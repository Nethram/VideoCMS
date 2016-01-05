<?php

	//Configure Database

	$hostname="localhost";		//Your Host
	$username="root";			//Username for database
	$password="";				//Password for database
			
	mysql_connect($hostname,$username,$password);
	mysql_select_db("vms_nethram");


	//Configure Amazaon S3
	
	$bucket = '';	//Your Bucket Name
	$key='';		//Your Key
	$secret='';		//Your Secret Key

	//Configure JW Player

	$jwkey="";		//key for your JW Player, Free version is also available

?>