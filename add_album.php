<?php require_once('head.php'); ?>
<?php

$suppliers = $auth_admin->getAllSuppliers();
$formErrors = [];
$formErrors["albumSupplier"] = "";
$formErrors["albumName"] = "";

//Proccess Images
/**
 * @param $supplierId
 * @param $albumName
 * @return array
 */
function validateForm($supplierId, $albumName)
{
    $isValid = true;
    if (empty($supplierId)) {
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
function saveAlbum($auth_admin)
{
    $supplierId = $_POST["albumSupplier"];
    $albumName = $_POST["albumName"];

    $isValid = validateForm($supplierId, $albumName);
    if (!$isValid) {
        return false;
    }

    // first - save album record in DB
    $albumId = $auth_admin->saveAlbumRecord($albumName, $supplierId);


    // save the album to the file system
    extract($_POST);
    $error = array();
    $extension = array("jpeg", "jpg", "png", "gif");
    foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
        $file_name = $_FILES["files"]["name"][$key];
        $file_tmp = $_FILES["files"]["tmp_name"][$key];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $time = time();

        $supplierAlbumsPath = ALBUMS_PATH . $supplierId;
        $currentAlbumPath = $supplierAlbumsPath . "/" . $albumId;
        if (!file_exists($supplierAlbumsPath)) {
            mkdir($supplierAlbumsPath, 0777);
        }
        if (!file_exists($currentAlbumPath)) {
            mkdir($currentAlbumPath, 0777);
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

if (isset($_POST['create'])) {
    saveAlbum($auth_admin);
}
?>

<body>
<!-- Static navbar -->
<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>
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
                                    <input type="file" name="files[]" multiple/></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">Note: Supported image format: .jpeg, .jpg, .png, .gif
                                </td>
                            </tr>
                            <tr>
                                <td>Album Name:</td>
                                <td>
                                    <input type="text" name="albumName"/>
                                    <span class="error"><? echo $formErrors["albumName"];?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Album Supplier:</td>
                                <td>
                                    <select name="albumSupplier">
                                        <?php
                                        foreach ($suppliers as $supplier) {
                                            $output = '<option value="' . $supplier['supplier_id'] . '">';
                                            $output .= $supplier['first_name'] . ' ' . $supplier['last_name'] . '</option>';
                                            echo $output;
                                        }
                                        ?>
                                    </select>
                                </td>
                                <span class="error"><? echo $formErrors["albumSupplier"];?></span>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input type="submit" name="create" value="Create Gallery" id="selectedButton"/></td>
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