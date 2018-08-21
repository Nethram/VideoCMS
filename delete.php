<?php
	include("db/db.php");
	require 'amazon/aws-autoloader.php';
	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;

	$video_id=$_POST["video_id"];
	$check_server=mysql_query("select * from videos where video_id=$video_id");
	$array=mysql_fetch_array($check_server);
	
	if(file_exists($array["s3_url"]))//File is in local server
	{
		unlink($array["s3_url"]);
		unlink($array["thumnail"]);
		$delete=mysql_query("delete from videos where video_id=$video_id");
		
		if($delete)
		{
			echo "Deleted Successfully";
		}
	}
	else if(!file_exists($array["s3_url"]))//The file is in S3
	{
		global $bucket, $key, $secret;
		
    	$keyname = $array["name"];

		$s3 = S3Client::factory(array(
        	'key'    => $key,
        	'secret' => $secret,
    	));

		try
    	{

    		$result = $s3->deleteObject(array(
    			'Bucket' => $bucket,
    			'Key'    => $keyname
			));

			if($result)
			{
				$delete=mysql_query("delete from videos where video_id=$video_id");
				if($delete)
				{
					echo "Deleted Successfully";
				}
			}
			else
			{
					echo "No such files";
			}
		}
		catch (S3Exception $e) 
    	{
        
    	}
	}
	
	

// 	 function write_to_log($str)
// {
//   file_put_contents("upload_log.txt", gmdate("Y-m-d H:i:s")." --> ".$str."\r\r",FILE_APPEND);
// }

	

?>