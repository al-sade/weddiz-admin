<?php
require_once('head.php');
?>
<?php
$albumId    = $_GET['album_id'];
$supplierId = $_GET['supplier_id'];
$albumName  = $_GET['album_name'];

if (isset($_POST['delete'])) {
    $img_path = $_POST['delete'];
    try {
        unlink($img_path);
        echo "<meta http-equiv='refresh' content='0'>";
    }
    catch (Exception $e) {
        return $e;
    }
}

?>

<body>
<!-- Static navbar -->
<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>
        <div id="wrapper">
            <div class="content-wrapper container">
                <div class="page-title">
                    <h1>אלבומים <small></small></h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i></a></li>
                        <li class="active">רשימת אלבומים</li>
                        <li class="active"><?php echo $albumName; ?></li>
                    </ol>
                            </div>
                <div class="row">
                    <div class="col-sm-12">
                        <section class="page">
                            <h2><?php echo $albumName; ?></h2>             
                            <?php $files = glob(ALBUMS_PATH . $supplierId . "/" . $albumId . "/*.*");

                            foreach ($files as $file) {
                                $image = $file;
                                
                                $supported_file = array(
                                    'gif',
                                    'jpg',
                                    'jpeg',
                                    'png'
                                );
                                
                                $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
                                
                                if (in_array($ext, $supported_file)) {
                                    $imgSrc = "image.php?path=" . $image;
                                    
                                    $output = '<div class="album-img" style="background-image: url(' . $imgSrc . ');">';
                                    $output .= '<form method="post">';
                                    $output .= '<button class="delete-img" type="submit" name="delete"  value="' . $image . '">';
                                    $output .= '</button></form>';
                                    $output .= '</div>';
                                    echo $output;
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