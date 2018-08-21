
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Video Management System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">



  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>V</b>CMS</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Video</b>CMS</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Videos</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-files-o"></i>
                <span>Upload</span>
              </a>
            </li>
            <li>
              <a href="manage.php">
                <i class="fa fa-th"></i> <span>Manage</span>
              </a>
            </li>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content">
          <h1>
            Video
            <small>Management System</small>
          </h1>
        

        <!-- Main content -->
        
        
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-4 col-xs-6 ">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>Videos</h3>
                  <p>See All Your Videos</p>
                </div>
                <div class="icon">
                  <i class="fa fa-play"></i>
                </div>
                <a href="#" class="small-box-footer">Go Here <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>Upload</h3>
                  <p>Upload New Video</p>
                </div>
                <div class="icon">
                  <i class="fa fa-cloud-upload"></i>
                </div>
                <a href="#" data-toggle="modal" data-target="#myModal" class="small-box-footer">Click Here <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>Manage</h3>
                  <p>Manage Your Videos</p>
                </div>
                <div class="icon">
                  <i class="fa fa-gears"></i>
                </div>
                <a href="manage.php" class="small-box-footer">Go Here <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Main row -->


		<div class="row">
      <?php
        include("db/db.php");
        $get_cat=mysql_query("select * from categories");
        while($array=mysql_fetch_array($get_cat))
        {
            $cat_id=$array["category_id"];
            
             $get_videos=mysql_query("select distinct videos.* from videos,categories,vid_cat where videos.video_id IN (select video_id from vid_cat where cat_id=$cat_id)");
              $array2=mysql_fetch_array($get_videos);
              if($array2["name"]=="")
              {
                  ?>
                    <div class="box box-defaul" >
              
            <div class="box-header with-border">
              <h3 class="box-title"><?=$array["category_name"];?></h3>
              <div class="box-tools pull-right">

                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div><!-- /.box-header -->


                  <?php
              }
              else
              {

      ?>
		    <div class="box box-defaul" >
              
            <div class="box-header with-border">
              <h3 class="box-title"><?=$array["category_name"];?></h3><a href="playlist.php?list=<?=$cat_id?>" class="btn btn-sm fa fa-play"> Play </a>
              <div class="box-tools pull-right">

                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body" style="background:#D3DEE6;">
			     <?php


            $get_videos=mysql_query("select distinct videos.* from videos,categories,vid_cat where videos.video_id IN (select video_id from vid_cat where cat_id=$cat_id)");
            while($array2=mysql_fetch_array($get_videos))
            {
          ?>


            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <a href="watch.php?video=<?php echo $array2['video_id'];?>"><span class="info-box-icon"><img src="<?php echo $array2['thumnail'];?>" height="87%" width="200"></a></span>
                <div class="info-box-content">
                  <span class="info-box-text"><a href="watch.php?video=<?php echo $array2['video_id'];?>" style="text-decoration:none;color:#163F63;">
                  <b>
                  	<?php 
                        if(empty($array2['title']))
                            echo $array2["name"];
                        else
                        	echo $array2["title"];
                    ?>
                  </b>
                  </a>
                  </span>
                  <span class=""><a href="watch.php?video=<?php echo $array2['video_id'];?>" style="text-decoration:none;color:green;">
                  	<?php 
                            if(empty($array2['description']))
                              echo "";
                            else
                              echo substr($array2["description"],0,20)."...";
                    ?>
                    </a>
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
             <?php
            }
           ?>
        </div>
		</div>
       <?php
          }
        }
      ?>
    <div class="box box-defaul" >
              
            <div class="box-header with-border">
              <h3 class="box-title">Others</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body" style="background:#D3DEE6;">
      <?php
          $others=mysql_query("select distinct videos.* from videos,categories,vid_cat where videos.video_id NOT IN (select video_id from vid_cat)");
          while($array3=mysql_fetch_array($others))
          {
      ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <a href="watch.php?video=<?php echo $array3['video_id'];?>"><span class="info-box-icon"><img src="<?php echo $array3['thumnail'];?>" height="87%" width="200"></a></span>
                <div class="info-box-content">
                  <span class="info-box-text"><a href="watch.php?video=<?php echo $array3['video_id'];?>" style="text-decoration:none;color:#163F63;">
                  <b>
                    <?php 
                        if(empty($array3['title']))
                            echo $array3["name"];
                        else
                          echo $array3["title"];
                    ?>
                  </b>
                  </a>
                  </span>
                  <span class=""><a href="watch.php?video=<?php echo $array3['video_id'];?>" style="text-decoration:none;color:green;">
                    <?php 
                            if(empty($array3['description']))
                              echo "";
                            else
                              echo substr($array3["description"],0,20)."...";
                    ?>
                    </a>
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
    <?php
          }

    ?>
    </div>
    </div>
		</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="http://nethram.com">Nethram</a>.</strong> All rights reserved.
      </footer>

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Upload Video</h4>
                        </div>
                        <div class="modal-body">
                           <form method="post" role="form" id="uploadform" enctype="multipart/form-data" action="uploader.php" >
                          <div class="info-box">
                            <div class="form-group">
                              <label>Select Video File</label>
                              <input type="file" class="form-control" name="video" id="video" required/>
                            </div>

                            <div class="form-group">
                              <label>Select Thumbnail Image</label>
                              <input type="file" class="form-control" name="thumbnail" id="video" required/>
                            </div>

                   
                            
                            <input type="submit" value="Upload" class="btn btn-primary" id="upload"/>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           
                            <div></div>
                             <!-- progress bar added -->
                                        <div id="myProgress" style="display:none; width: 100%;background-color: #ddd;">
                                                  <div id="myBar"style="width: 10%;
                                                                        height: 30px;
                                                                        background-color: #4CAF50;
                                                                        text-align: center;
                                                                        line-height: 30px;
                                                                        color: white;">10%
                                                  </div>  
                                        </div>


                                <div>
                                </div>       
                             
                          </div>
                      </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

                <!-- jQuery 2.1.4 -->
 <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
 
 <!-- adding jquery form plugin --> 
 <script src="//oss.maxcdn.com/jquery.form/3.50/jquery.form.min.js"></script>


    <!-- jQuery 2.1.4 -->
    <!-- <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script> -->
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>

    
    <script src="bootstrap/bootbox.min.js"></script>
   
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- Select -->
    <script src="plugins/select2/select2.full.min.js"></script>
 	<script>
      $(function () {
        
        $(".select2").select2();
      });
    </script>
    <script>

    $(document).ready(function(){

var percent = $('#percent');
          var status = $('#status');

          $('#uploadform').ajaxForm({
              beforeSend: function() {
              status.empty();
              $("#upload").val("uploading...");
              document.getElementById("upload").setAttribute("disabled", 'true');
              $('#myProgress').show();
              var elem = document.getElementById("myBar");   
              var percentVal = '0%';
              elem.style.width = percentVal; 
              elem.innerHTML = percentVal;
            },
              uploadProgress: function(event, position, total, percentComplete) {
                var elem = document.getElementById("myBar"); 
              var percentVal = percentComplete + '%';
              elem.style.width = percentVal; 
              elem.innerHTML = percentVal;
            },
              complete: function(xhr) {
             

                  if(xhr.responseText=="Invalid")
                    {
                      bootbox.alert("Invalid File Formats");
                      document.getElementById("upload").disabled = false;
                      $("#upload").val("upload");
                      $('#myProgress').hide();
                    }

                    else if(!isNaN(xhr.responseText))
                    {

                       bootbox.alert("Uploaded Successfully");
                        document.getElementById("upload").disabled = false;
                      $("#upload").val("upload");
                       $('#myProgress').hide();
                                           
                      /*$("#example1").load(location.href + " #example1");*/
                      location.href="watch.php?video="+xhr.responseText;
                    }
                    
                    else
                    {
                      bootbox.alert("Uploading Failed");
                      document.getElementById("upload").disabled = false;
                      $("#upload").html("upload");
                      $('#myProgress').hide();
                    }
            }
          });

       
    });
    </script>


  </body>
</html>
