<?php require_once('head.php'); ?>
    <?php
//Proccess Images
if(isset($_POST['create'])){
extract($_POST);
    $error=array();
    $extension=array("jpeg","jpg","png","gif");
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
            {
                $file_name=$_FILES["files"]["name"][$key];
                $file_tmp=$_FILES["files"]["tmp_name"][$key];
                $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                $time = time();
//                var_dump('images/albums/'.$time);
                if (!file_exists('/var/www/html/wed-admin/images'.$time)) {
                        mkdir("images/albums/$time", 0777);
                }
                $txtGalleryName = 'images/albums/'.$time; //must exists
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
}
?>

<body>
<!-- Static navbar -->
<?php include('includes/header.php');?>
    <?php include('includes/sidebar.php');?>
        <div id="wrapper">
            <div class="content-wrapper container">
                <div class="row">
                    <div class="col-sm-12">
                        <section class="page">
                            <form method="post" enctype="multipart/form-data">
                                <table width="100%">
                                    <tr>
                                        <td>Select Photo (one or multiple):</td>
                                        <td>
                                            <input type="file" name="files[]" multiple/> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">Note: Supported image format: .jpeg, .jpg, .png, .gif</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <input type="submit" name="create" value="Create Gallery" id="selectedButton" /> </td>
                                    </tr>
                                </table>
                            </form>
                        </section>
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