<?php require_once('head.php'); ?>
<?php 
$album_name = $_GET['album_name'];
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
                                    <li class="active"><?php echo $album_name; ?></li>
                                </ol>
                            </div>
                <div class="row">
                    <div class="col-sm-12">
                        <section class="page">
                            <h2><?php echo $album_name; ?></h2>
                                                                    
                            <?php
                               $files = glob("images/albums/".$album_name."/*.*");

                                 for ($i=1; $i<count($files); $i++)

                                {

                                $image = $files[$i];
                                $supported_file = array(
                                'gif',
                                'jpg',
                                'jpeg',
                                'png'
                               );

                               $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
                               if (in_array($ext, $supported_file)) {
                                   $output = '<div class="album-img" ';
                                   $output .= 'style="background-image: url('.$image.')"></div>';
                                   echo $output;
//                                echo '<img src="'.$image .'" alt="Random image" />'."<br /><br />";
                               } else {
                                continue;
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