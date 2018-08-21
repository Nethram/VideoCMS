<?php
	include("db/db.php");
	require 'amazon/aws-autoloader.php';
	use Aws\S3\S3Client;
	use Aws\S3\Exception\S3Exception;

	

	if((isset($_FILES["video"]["name"]))&&(isset($_FILES["thumbnail"]["name"])))
	{
		
		$video_file=$_FILES["video"]["name"];
		$thumbnail_image=$_FILES["thumbnail"]["name"];
		
		$video_allowed =  array('mp4','avi' ,'3gp','mkv');
		$thumbnail_allowed= array('jpeg','png','jpg');

		$video_ext = pathinfo($video_file, PATHINFO_EXTENSION);
		$thumbnail_ext=pathinfo($thumbnail_image, PATHINFO_EXTENSION);

		if((!in_array($video_ext,$video_allowed))||(!in_array($thumbnail_ext,$thumbnail_allowed))) 
		{
			echo "Invalid";
			exit;
		}

		$video_target = "uploads/videos/"; 
		$video_target = $video_target .mt_rand(1000000,10000000000). basename( $_FILES["video"]["name"]);




		$thumbnail_target = "uploads/thumbnails/"; 
		$thumbnail_target = $thumbnail_target .mt_rand(1000000,10000000000). basename( $_FILES["thumbnail"]["name"]);
	
		$url="";

		if((move_uploaded_file($_FILES['video']['tmp_name'], $video_target))&&(move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnail_target)))
		{
			/*echo $video_target."<br/>";
			echo $thumbnail_target;*/
			
			$db_insert="";
			if(isset($_POST["re_upload_video_id"]))
			{
				$keyname = $video_file;					
				$filepath = $video_target;
				if(s3UploadCheck())
				{
					$url=s3Url($keyname,$filepath);
					unlink($filepath);
				}
				else
				{
					$url=$video_target;
				}
				
				$video_id=$_POST["re_upload_video_id"];
				$db_insert=mysql_query("update videos set name='$video_file',thumnail='$thumbnail_target',s3_url='$url' where video_id=$video_id ");
				echo $video_id;
			}
			else
			{
				
				$keyname = $video_file;					
				$filepath = $video_target;
				if(s3UploadCheck())
				{
					
					$url=s3Url($keyname,$filepath);
					unlink($filepath);
				
				}
				else
				{
					$url=$video_target;
				}
				
				
				$db_insert=mysql_query("insert into videos values(null,'$video_file','','','$thumbnail_target','$url' )");
				if($db_insert)
				{
					echo mysql_insert_id();
    			
				}
				else
				{
					echo "failed";
				}
			}

		}
	}
	else
	{
		echo "Upload Failed";
	}
/*
function isInternet()
{
	$host="www.google.com";
	return (bool) @fsockopen($host,80,$num,$err,10);
}*/
function s3UploadCheck()
{
	$query=mysql_query("select * from settings");
	$array=mysql_fetch_array($query);
	if($array['s3_upload']==1)
		return true;
	else
		return false;
}


function s3Url($keyname,$filepath)
{
    global $bucket, $key, $secret;
	
    
    $keyname = $keyname;
    // $filepath should be absolute path to a file on disk                      
    $filepath = $filepath;
                        


    $s3 = S3Client::factory(array(
        'key'    => $key,
        'secret' => $secret,
    ));

    try
    {


        // Upload a file.
        $result = $s3->putObject(array(
            'Bucket'       => $bucket,
            'Key'          => $keyname,
            'SourceFile'   => $filepath,
            'ContentType'  => 'text/plain',
            'ACL'          => 'public-read',
            'StorageClass' => 'REDUCED_REDUNDANCY',
            'Metadata'     => array(    
                'param1' => 'value 1',
                'param2' => 'value 2'
            )
        ));

        return $result['ObjectURL'];
    }

    catch (S3Exception $e) 
    {
        
    }
}



// function write_to_log($str)
// {
// 	file_put_contents("upload_log.txt", gmdate("Y-m-d H:i:s")." --> ".$str."\r\r",FILE_APPEND);
// }

	
?>