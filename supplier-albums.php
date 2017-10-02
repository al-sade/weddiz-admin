<?php require_once('head.php'); ?>
    <?php

$supplier_id = $_GET['sid'];
$supplier = $auth_admin->getSupplier($supplier_id);
$supplier_name = $supplier['first_name'].' '.$supplier['last_name'];
$supplier_albums = $auth_admin->getSupplierAlbums($supplier_id);
$auth_admin->saveAlbumRecord("test", "15");

//Proccess Images
if(isset($_POST['create'])){
extract($_POST);
    $error=array();
    $extension=array("jpeg","jpg","png","gif");
    $time = time();
    $album_name = $time.'_'.$supplier_id;
    $album_path=  'images/albums/'.$album_name;
    
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
            {
                $file_name=$_FILES["files"]["name"][$key];
                $file_tmp=$_FILES["files"]["tmp_name"][$key];
                $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                if (!file_exists($album_path)) {
                    mkdir($album_path, 0775, true);
                }                
                $txtGalleryName = $album_path; //must exists
                if(in_array($ext,$extension))
                {
                    if(!file_exists($txtGalleryName."/".$file_name))
                    {
                        move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],$txtGalleryName."/".$file_name);
                    }
                    else
                    {
                        $filename=basename($file_name,$ext);
                        $newFileName=$filename.$time.".".$ext;
                        move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],$txtGalleryName."/".$newFileName);
                    }
                }
                else
                {
                    array_push($error,"$file_name, ");
                }
            }
    $auth_admin->saveAlbumRecord($album_name, $supplier_id);
}
?>

        <body>
            <!-- Static navbar -->
            <?php include('includes/header.php');?>
                <?php include('includes/sidebar.php');?>
                    <div id="wrapper">
                            <div class="content-wrapper container">
                                                         <div class="page-title">
                                <h1>אלבומים <small></small></h1>
                                <ol class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                    <li class="active">רשימת אלבומים</li>
                                </ol>
                            </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="profile-edit" style="background-color:transparent;">
                                        <section class="page">
                                            <h2><?php echo $supplier_name; ?></h2>
                                            <hr>
                                            <form method="post" enctype="multipart/form-data">
                                                <table width="100%">
                                                    <tbody style="float: right;">
                                                        <tr>
                                                            <td>
                                                                <input type="file" name="files[]" placeholder="בחר" id="files" class="hidden" multiple/> </td>
                                                            <label class="upload-album" for="files">בחר תמונה/תמונות</label>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" align="center">פורמטים נתמכים: .jpeg, .jpg, .png, .gif</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" align="center" style="float: right;">
                                                                <input type="submit" name="create" value="צור אלבום" id="selectedButton" /> </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </form>
                                        </section>
                                        </div>
                                    </div>
                                    <div class="col-md-8 margin-b-30">
                                        <div class="profile-edit">
                                            <h2 class="mb-xlg">אלבומים</h2>
                                            <hr> 
                                        
                                            <?php
                                                foreach($supplier_albums as $album){
                                                    $output = '<div class=" gallery-col">';
                                                    $output .= '<a href="album.php?album_name='.$album['album_name'].'" class="show-image">';
                                                    $output .= '<img src="images/img-1.jpg" alt="" class="img-responsive">';
                                                    $output .= $album['album_name'];
                                                    $output .= '</a>';
                                                    echo $output;
                                                }
                                            ?>
                                            
                            <div class="clearfix"></div>
                        </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <script type="text/javascript" src="js/jquery.min.js"></script>
                    <script type="text/javascript" src="bootstrap-rtl-master/dist/js/bootstrap-rtl.min.js"></script>
                    <script src="js/metisMenu.min.js"></script>
                    <script src="js/jquery.nanoscroller.min.js"></script>
                    <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
                    <script src="js/pace.min.js"></script>
                    <script src="js/waves.min.js"></script>
                    <script src="js/jquery-jvectormap-world-mill-en.js"></script>
                    <!--        <script src="js/jquery.nanoscroller.min.js"></script>-->
                    <script type="text/javascript" src="js/custom.js"></script>
        </body>

        </html>