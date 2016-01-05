<?php
	include("db/db.php");
	$video_id=$_POST["video_id"];
	$get_details=mysql_query("select * from videos where video_id=$video_id");
	$array_deatils=mysql_fetch_row($get_details);
	

	

	$array_categories=array();
	$i=0;
	$get_categories=mysql_query("select categories.category_name from categories,vid_cat where vid_cat.cat_id=categories.category_id and vid_cat.video_id=$video_id");
	while($row=mysql_fetch_row($get_categories))
	{
		$array_categories[$i]=$row[0];
		$i++;
	}

	$result=array_merge($array_deatils,$array_categories);
	echo json_encode($result);

?>