<?php
	include("db/db.php");
	$category_id=$_POST["category"];   
	$get_videos=mysql_query("select distinct videos.* from videos,categories,vid_cat where videos.video_id IN (select video_id from vid_cat where cat_id=$category_id)");
	while($array=mysql_fetch_array($get_videos))
				{



			?>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <a href="watch.php?video=<?php echo $array['video_id'];?>"><span class="info-box-icon"><img src="<?php echo $array['thumnail'];?>" height="87%" width="200"></a></span>
                <div class="info-box-content">
                  <span class="info-box-text"><a href="watch.php?video=<?php echo $array['video_id'];?>" style="text-decoration:none;color:#163F63;">
                  	<b>
                  	<?php 
                        if(empty($array['title']))
                            echo $array["name"];
                        else
                        	echo $array["title"];
                    ?>
                  </b>
                  </a>
                  </span>
                  <span class=""><a href="watch.php?video=<?php echo $array['video_id'];?>" style="text-decoration:none;color:green;">
                  	<?php 
                            if(empty($array['description']))
                              echo "";
                            else
                              echo substr($array["description"],0,20)."...";
                    ?>
                    </a>
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

<?php
          }
?>

