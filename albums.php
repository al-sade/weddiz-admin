<?php require_once('head.php'); ?>
<?php 
$albums = $auth_admin->getAllAlbums();
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
                    <div class="col-sm-12">
                        <section class="page">
                            <?php 
                            foreach($albums as $album){ 
                               $search_dir = "images/albums/".$album['album_name'];
                                $images = glob("$search_dir/*.*");
                                sort($images);
                                //display one image:
//                                var_dump($images);
                                if(isset($images[0])){
                                echo '<a href="album.php?album_name='.$album['album_name'].'">';
                                echo "<img src='$images[0]' height='150' width='150' /> </a>";
                                }
                            } 
                            ?>
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