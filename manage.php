<?php
  session_start();
  include("db/db.php");

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>VMS| Manage</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">

   

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
           <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                            <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle"  id="myid">
                  <i class="fa fa-wrench"></i>
                  
                </a>
                <ul class="dropdown-menu" id="mydrop">
                  <li class="header">Settings</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <?php
                        $current_settings=mysql_query("select * from settings");
                        $array=mysql_fetch_array($current_settings);

                        $s3_upload=$array['s3_upload'];
                       
                      ?>

                      <li>
                        <a href="#">
                          <p>Check your option</p>
                          <h4>
                          <form id="s3_form">
                           <input type="checkbox" name="s3_upload" id="s3_upload" <?php if($s3_upload==1) echo "checked"; else echo "required";?>>Upload to Amazon S3
                          </h4>
                          
                        </a>
                      </li>

                      

                      <li>
                        <a href="#">
                          
                          <h4>
                            <button class="btn btn-primary" name="video" id="save_settings" type="submit">Save</button>
                          </h4>
                          </form>
                        </a>
                      </li>
                    
                      
                    </ul>
                  </li>
                  
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
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
            <li class="active treeview">
              <a href="#">
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
                <a href="index.php" class="small-box-footer">Go Here <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="#" class="small-box-footer">Go Here <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Main row -->
          <div class="row">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Videos</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Video Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        
                        /*select distinct videos.*,categories.category_name from videos,categories,vid_cat where videos.video_id=vid_cat.video_id and vid_cat.cat_id=categories.category_id*/
                        $get_videos=mysql_query("select * from videos order by video_id asc");
                        while($array=mysql_fetch_array($get_videos))
                        {

                          $video_id=$array['video_id'];
                          $get_category=mysql_query("select categories.category_name from categories,vid_cat where vid_cat.cat_id=categories.category_id and vid_cat.video_id=$video_id");


                      ?>
                    
                      <tr>
                        <td>
                          <a href="watch.php?video=<?=$array['video_id']?>"><img src="<?=$array['thumnail']?>" heigth="30" width="30"/></a>
                          <?php 
                            if(empty($array['title']))
                              echo $array["name"];
                            else
                              echo $array["title"];
                          ?>
                        </td>
              
                        <td>
                          <?php 
                            if(empty($array['description']))
                              echo "&lt; Not Set &gt;";
                            else
                              echo $array["description"];
                          ?>
                      </td>
                    <td>
                      <?php 
                          while($category_array=mysql_fetch_array($get_category))
                          {
                            echo $category_array['category_name'].", ";
                          }
                      ?>

                    </td>
                    
                    <td>
                      <button class="btn btn-success btn-xs edit" data-vid="<?=$array['video_id']?>">
                      
                        <i class="fa fa-edit"></i>
                           Edit
                      
                      </button>
  
                    <button class="btn btn-danger btn-xs delete" data-vid="<?=$array['video_id']?>">
                    
                        <i class="fa fa-trash"></i>
                           Delete
                      
                    </button> 
                    </td>
                  </tr>

           <?php
              }
            ?>
                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Video Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Action</th>
                       
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.1.0
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="http://nethram.com">Nethram</a>.</strong> All rights reserved.
      </footer>

            <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      
    </div><!-- ./wrapper -->

<!--UPLOAD MODAL-->

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

            <div class="modal " id="edit_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Edit Video Information</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" action="update.php" method="post">
                                <div class="info-box">
                                  <div class="form-group">
                                    <label>Video Title</label>
                                      <input type="text" class="form-control" name="title" id="title"/>
                                   </div>

                                  <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" name="description" id="description"/>
                                  </div>

                                  <div class="form-group">
                                    <label>Category</label>
                                    <div><label>Current Categories : </label><label id="current_categoies"></label></div>
                                    <div id="select2">
                                      <select class="form-control select2" multiple="multiple" data-placeholder="Select Category" style="width: 100%;" id="category" name="category[]">
                                      

                                      </select>
                                    </div>
                                  </div>

                   
                                  <input type="hidden" id="video_id" name="video_id"/>
                                  <input type="submit" value="Update" class="btn btn-primary" id="update"/>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                          <a class="btn btn-box-tool btn-lg" data-toggle="modal" data-target="#reUpload" ><i class="fa fa-cloud-upload"></i>Click to Upload again</a>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


<!--RE-UPLOAD MODAL-->

              <div class="modal fade" id="reUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Re-Upload Video</h4>
                    </div>
                    <div class="modal-body">
                      <form role="form" id="re_uploadform" enctype="multipart/form-data">
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

<!--SETTINGS Modal-->
              <div class="modal fade" id="settings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">VMS Settings</h4>
                    </div>
                    <div class="modal-body">
                      <form role="form" id="settings_form" enctype="multipart/form-data">
                          
                            <div class="form-group">
                              <label>
                                
                                Upload to Amazon S3
                                <input type="checkbox" class="icheckbox" name="video" id="video" required/>
                              </label>
                            </div>

                            <div class="form-group">
                              <label>Select Thumbnail Image</label>
                              
                            </div>

                   
                            
                            <input type="submit" value="Upload" class="btn btn-primary" id="upload"/>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          
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



    <!-- <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script> -->
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Select -->
    <script src="plugins/select2/select2.full.min.js"></script>

    <script src="bootstrap/bootbox.min.js"></script>
    <script>
      $(function () {
        $("#example1").DataTable();
        $(".select2").select2();
      });
    </script>

    <script type="text/javascript">

    $(document).ready(function(){
      
        $("#example1").on("click",".edit",function(){ 
          
          var vid ="video_id="+$(this).data('vid');
          var video_id=$(this).data('vid');
          localStorage.video_id=video_id;
          $.ajax({
                
                    type:"POST",
                    url:"getDetails.php",
                    cache: false,
                    data:vid,
                    success:function(response)
                    {
                       /* alert(response);*/
                        var obj = JSON.parse(response);

                        if(obj[2]=="")
                        {
                           $("#title").val(obj[1]);
                        }
                        else
                        {
                          $("#title").val(obj[2]);
                        }
                        
                        $("#description").val(obj[3]);
                        
                        $("#category").html("");

                        var current="";
                        for(var i=6;i<obj.length;i++)
                        {

                          current+=obj[i]+',';
                         
                        }
                        $("#current_categoies").html(current);
                        $('input[name=video_id]').val(video_id);
                        $.ajax({
                
                            type:"POST",
                            url:"getCategories.php",
                            cache: false,
                            success:function(response){
                              $("#category").html(response)
                            },
                            error:function(){
                              alert("Error During Ajax Call..!!!")
                            }
                        });
                      $('#edit_details').modal();
                                
                    },
                    error:function(){
                        alert("Error Durin Ajax Call..!!!")
                    }
                
          });
    
        })

        $("#category").change(function(){
              if($("#category").val()=="other")
              {
                /*$("#select2").css('visibility', 'hidden');*/
                var type="text";
                var name="new_category";
                var placeholder="Enter Category";
                var clas="form-control";
                                    
                var dest=document.getElementById("select2");
                var element=document.createElement("input");
                                    
                element.setAttribute("type",type);
                element.setAttribute("name",name);
                element.setAttribute("placeholder",placeholder);
                element.setAttribute("class",clas);
                dest.appendChild(element);
                 $("#category").select2("enable", false)
                /*$("#select2").show();*/

              }
        })


        $("#example1").on("click",".delete",function(e){
            e.preventDefault();
            var vid ="video_id="+$(this).data('vid');
            bootbox.confirm("Are you sure?", function(result)   
            {
              
                if(result==true)
                {
                    $.ajax({
                
                            type:"POST",
                            url:"delete.php",
                            cache: false,
                            data:vid,
                            success:function(response)
                            {
                              bootbox.alert(response);
                              location.reload();

                            },
                            error:function()
                            {
                              alert("Error During Ajax Call..!!!")
                            }
                  });
                  

                  
                }
            }); 
        })




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
                                           console.log("inside",xhr.response);
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

       





      $("#re_uploadform").on('submit',(function(e){
          e.preventDefault();
          var vid =localStorage.video_id;
          var data=new FormData(this);
          data.append('re_upload_video_id',localStorage.video_id);
          
          $.ajax({
                
                  type:"POST",
                  url:"uploader.php",
                  data:data,
                  contentType: false,
                  cache: false,
                  processData:false,
                  success:function(response)
                  {
                   if(response!="Invalid")
                    {
                      bootbox.alert("Re-Uploaded Successfully");
                      localStorage.video_id="";
                      /*$("#example1").load(location.href + " #example1");*/
                      location.href="watch.php?video="+response;
                    }
                    else if(response=="Invalid")
                    {
                      bootbox.alert("Invalid File Formats");
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
    <script type="text/javascript">
    $(document).ready(function(){
      $("#myid").click(function(){
        $("#mydrop").toggle();
      })

      $(".quality").change(function(){
        if($(".quality").is(":checked"))
        {
          $("#s3_upload").prop("checked","true");
        }
        
      })

      $("#s3_form").on('submit',(function(e){
         e.preventDefault();
         var data=$(this).serialize();
         $.ajax({
            type:"POST",
            url:"settings.php",
            data:data,

            success:function(response){
              if(response=="1")
                bootbox.alert("Settings Saved");

              else
                bootbox.alert("Saving Failed");

            },
            error:function(){
              bootbox.alert("Something went wrong, Try again");
            }

         });
        
      }))


    })
</script>
<?php
  
  if(isset($_SESSION["success"]))
  {
    
?>      
    <script>
      bootbox.alert("Updated Successfully");
    </script>
<?php   
  unset($_SESSION["success"]);          
      }

?> 


  </body>
</html>
