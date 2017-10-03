<?php require_once('head.php'); ?>

<?php

$supplier_id = $_GET['sid'];
$supplier = $auth_admin->getSupplier($supplier_id);
$supplier_name = $supplier['first_name'] . ' ' . $supplier['last_name'];
$supplier_albums = $auth_admin->getSupplierAlbums($supplier_id);

$suppliers = $auth_admin->getAllSuppliers();
$formErrors = [];
$formErrors["albumSupplier"] = "";
$formErrors["albumName"] = "";

//Proccess Images
/**
 * @param $supplier_id
 * @param $albumName
 * @return array
 */
function validateForm($supplier_id, $albumName)
{
    $isValid = true;
    if (empty($supplier_id)) {
        $formErrors["albumSupplier"] = "required field";
        $isValid = false;
    }
    if (empty($albumName)) {
        $formErrors["albumName"] = "required field";
        $isValid = false;
    }
    return $isValid;
}


/**
 * @param $auth_admin
 * @return bool
 */
function saveAlbum($supplier_id, $auth_admin)
{

    $albumName = $_POST["albumName"];

    $isValid = validateForm($supplier_id, $albumName);
    if (!$isValid) {
        return false;
    }

    // first - save album record in DB
    $albumId = $auth_admin->saveAlbumRecord($albumName, $supplier_id);


    // save the album to the file system
    extract($_POST);
    $error = array();
    $extension = array("jpeg", "jpg", "png", "gif");
    foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
        $file_name = $_FILES["files"]["name"][$key];
        $file_tmp = $_FILES["files"]["tmp_name"][$key];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $time = time();

        $supplierAlbumsPath = ALBUMS_PATH . $supplier_id;
        $currentAlbumPath = $supplierAlbumsPath . "/" . $albumId;
        if (!file_exists($supplierAlbumsPath)) {
            mkdir($supplierAlbumsPath, 0775, true);
        }
        if (!file_exists($currentAlbumPath)) {
            mkdir($currentAlbumPath, 0775, true);
        }
        $txtGalleryName = $currentAlbumPath; //must exists
        if (in_array($ext, $extension)) {
            if (!file_exists($txtGalleryName . "/" . $file_name)) {
                move_uploaded_file($file_tmp = $_FILES["files"]["tmp_name"][$key], $txtGalleryName . "/" . $file_name);
            } else {
                $filename = basename($file_name, $ext);
                $newFileName = $filename . $time . "." . $ext;
                move_uploaded_file($file_tmp = $_FILES["files"]["tmp_name"][$key], $txtGalleryName . "/" . $newFileName);
            }
        } else {
            array_push($error, "$file_name, ");
        }
    }
}

function deleteAlbum($supplier_id, $album_id, $auth_admin) {
    $album_path = ALBUMS_PATH . $supplier_id . "/" . $album_id;
    try{
        array_map('unlink', glob("$album_path/*.*"));
        $res = rmdir($album_path);
        $auth_admin->deleteAlbum($album_id);
        return $res;
    } catch (Exception $e){
        return $e;
    }
}

if (isset($_POST['create'])) {
    saveAlbum($supplier_id, $auth_admin);
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['album_id'])) {
    $album_id = $_POST['album_id'];
    deleteAlbum($supplier_id, $album_id, $auth_admin);
    echo "<meta http-equiv='refresh' content='0'>";
}

?>

<body>
<!-- Static navbar -->
<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>
<div id="wrapper">
    <div class="content-wrapper container">
        <div class="page-title">
            <h1>אלבומים
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-home"></i></a></li>
                <li class="active">רשימת אלבומים</li>
                <li class="active"><?php echo $supplier_name ?></li>
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
                                    <td align="center">
                                        <input type="text" name="albumName" style="float: right;margin: 15px 0;"
                                               placeholder="שם אלבום"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="file" name="files[]" placeholder="בחר" id="files" class="hidden"
                                               multiple/>
                                        <label class="upload-album" for="files">בחר תמונה/תמונות</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">פורמטים נתמכים: .jpeg, .jpg, .png, .gif</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center" style="float: right;">
                                        <input type="submit" name="create" value="צור אלבום" id="selectedButton"/></td>
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
                    foreach ($supplier_albums as $album) {
                        $cover_photo = "images/img-1.jpg"; // Default Fallback Photo

                        $files = glob(ALBUMS_PATH . $supplier_id . "/" . $album['album_id'] . "/*.*");
                        foreach ($files as $image) {
                            $supported_file = array('gif', 'jpg', 'jpeg', 'png');
                            $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
                            if (in_array($ext, $supported_file)) {
                                $cover_photo = "image.php?path=" . $image;
                                break;
                            }
                        }

                        $link = 'album.php?album_name=' . $album['album_name'] . '&supplier_id=' . $supplier_id . '&album_id=' . $album['album_id'];
                        $output = '<div class="gallery-col">';
                        $output .= '<a href="' . $link . '" class="show-image">';
                        $output .= '<form method="post">';
                        $output .= '<button class="delete-album" type="submit" name="album_id"  value="'.$album['album_id'].'">';
                        $output .= '</button></form>';
                        $output .= '<div style="background-image: url('.$cover_photo.');" alt="" class="album-cover"></div>';
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
