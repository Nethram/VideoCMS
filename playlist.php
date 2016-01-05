<?php 
  include("db/db.php");
  $category_id=$_GET["list"];
  $get_videos=mysql_query("select distinct videos.* from videos,categories,vid_cat where videos.video_id IN (select video_id from vid_cat where cat_id=$category_id)");
    
  $playlist="";
  while(($array=mysql_fetch_array($get_videos))!=null)
  {
    $video_name="";
    if(empty($array['title']))
        $video_name=$array["name"];
    else
      $video_name=$array["title"];
    $video_thumb=$array['thumnail'];
    $video_url=$array['s3_url'];
    $video_desc=$array['description'];

      /*playlist: [{file: 'myvideo.mp4',image: 'myposter.png',title: 'My Video',description:'123456'},]*/

      /*$playlist=$playlist."{0:{src:\"".$video_url."\",type:\"video/mp4\"}},";*/

      $playlist=$playlist."{file:\"".$video_url."\",image:\"".$video_thumb."\",title:\"".$video_name."\",description:\"".$video_desc."\"},";
    }
   
  $query_cat_name=mysql_query("select category_name from categories where category_id=$category_id");
  $row_cat_name=mysql_fetch_row($query_cat_name);
  $category_name=$row_cat_name[0];
   
    
?>

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

    <!-- Load player theme -->
    <link rel="stylesheet" href="player/themes/maccaco/projekktor.style.css" type="text/css" media="screen" />

    <!-- Load jquery -->
    <script type="text/javascript" src="player/jquery-1.9.1.min.js"></script>

    <!-- load projekktor -->
    <script type="text/javascript" src="player/projekktor-1.3.09.min.js"></script>

<?php

    
?>
   
  
  </head>
  <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
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
              <a href="index.php">
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

          <div class="row">
            <div class="col-md-12">
              <div class="box box-solid box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?=$category_name?> Playlist</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                   <div id="myElement">Loading the player...</div>
                </div><!-- /.box-body -->
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
                      <form role="form" id="uploadform" enctype="multipart/form-data">
                          <div class="info-box">
                            <div class="form-group">
                              <label>Select Video File</label>
                              <input type="file" class="form-control" name="video" id="video"/>
                            </div>

                            <div class="form-group">
                              <label>Select Thumbnail Image</label>
                              <input type="file" class="form-control" name="thumbnail" id="video"/>
                            </div>

                   
                            
                            <input type="submit" value="Upload" class="btn btn-primary" id="upload"/>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    
   
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>


    <script src="bootstrap/bootbox.min.js"></script>


    <script>

    $(document).ready(function(){
      $("#uploadform").on('submit',(function(e){
          e.preventDefault();
          var data=new FormData(this);

          $.ajax({
                
                  type:"POST",
                  url:"uploader.php",
                  data:data,
                  contentType: false,
                  cache: false,
                  processData:false,
                  success:function(response)
                  {
                   
                   if(response=="Invalid")
                    {
                      bootbox.alert("Invalid File Formats");
                    }

                    else if(!isNaN(response))
                    {
                      bootbox.alert("Uploaded Successfully");
                      /*$("#example1").load(location.href + " #example1");*/
                      location.href="watch.php?video="+response;
                    }
                    
                    else
                    {
                      bootbox.alert("Uploading Failed");
                    }
                    
                  },
                  error:function()
                  {
                    alert("Error During Ajax Call..!!!");
                  }
               });

              
        }))


    });
    </script>
    
    <script src="jwplayer/jwplayer.js"></script>
    <script>jwplayer.key="<?php echo $jwkey;?>";</script>
    <script type="text/javascript">
        var playerInstance = jwplayer("myElement");
          playerInstance.setup({
    
          playlist:[<?=$playlist?>],
          autostart:false,
          width: 1067,
          height: 360,
          aspectratio: "16:9",

   
      });
    </script>
  </body>
</html>

