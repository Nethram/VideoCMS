<?php
	
    include("db/db.php");

    $title=$_POST['title'];
    $description=$_POST['description'];
    $video_id= $_POST["video_id"];

    $update_details=mysql_query("update videos set title='$title', description='$description' where video_id=$video_id");
    if(isset($_POST['category']))
    {
        
    	foreach ($_POST['category'] as $selectedCategory)
    	{
    	
    		$update_category=mysql_query("insert into vid_cat values(null,$video_id,$selectedCategory)");
    	}
    }

    if(isset($_POST['new_category']))
    {
		 $insert_new=mysql_query("insert into categories value(null,'$_POST[new_category]')");
      
		
		if(mysql_affected_rows()==1)
		{
			$category_id= mysql_insert_id();
			$update_category=mysql_query("insert into vid_cat values(null,$video_id,$category_id)");

		}
    }
    session_start();
    $_SESSION["success"]=1;
    header("location:manage.php");

    
?>