<?php require_once('head.php'); ?>
    <?php
$categories = $auth_admin->getCategories();
$reco_categories = $auth_admin->getRecoCategories();
$locations = $auth_admin->getLocations();
?>
        <?php
	if(isset($_POST['register']))
{
	$first_name = strip_tags($_POST['first_name']);
	$last_name = strip_tags($_POST['last_name']);
	$email = strip_tags($_POST['email']);
	$phone = strip_tags($_POST['phone']);
	$address = strip_tags($_POST['address']);
	$rank = strip_tags($_POST['rank']);
	$category_id = strip_tags($_POST['category_id']);
	$location = strip_tags($_POST['location']);
	$price = strip_tags($_POST['price']);
	$video = strip_tags($_POST['video_link']);
	$desc = strip_tags($_POST['desc']);
	$fb_link = strip_tags($_POST['fb_link']);
    if(isset($_POST['reco']) && $_POST['reco']){
    $reco = strip_tags($_POST['reco']);
    } else{
        $reco = 0;
    }
	try {
    // upload image
    $target_dir = LOCAL;
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $file_name;

    if(strpos($category_id, 'r_') !== false){
		$auth_admin->registerRecoSupplier($file_name, $first_name, $last_name, $email, $phone, $address, $rank, $category_id, $location, $price, $video, $reco, $desc, $fb_link);
    } else{
        $auth_admin->registerSupplier($file_name, $first_name, $last_name, $email, $phone, $address, $rank, $category_id, $location, $price, $video, $reco, $desc, $fb_link);
    }

    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    $check = 1;
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
        // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    } catch (Exception $e) {
		echo $e->getMessage();
	}

}


	?>

            <body>
                <!-- Static navbar -->
                <?php include('includes/header.php');?>
                    <section class="page">
                        <?php include('includes/sidebar.php');?>
                            <div id="wrapper">
                                <div class="content-wrapper container">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="page-title">
                                                <h1>ספקים<small></small></h1>
                                                <ol class="breadcrumb">
                                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                                    <li class="active">הוספת ספק</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end .page title-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-card margin-b-30">
                                                <!-- Start .panel -->
                                                <div class="panel-body">
                                                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label"> תמונת פרופיל</label>
                                                            <div class="col-sm-10">
                                                                <div class="row"> </div>
                                                                <div class="col-md-4">
                                                                    <label class="btn btn-default btn-file">
                                                                        עדכן <input type="file" name="fileToUpload" id="fileToUpload" hidden>
                                                                    </label>

                                                            </div>
                                                        </div>
                                                      </div>
                                                      <div class="hr-line-dashed"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">שם פרטי</label>
                                                            <div class="col-sm-10">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="first_name" placeholder="שם פרטי" class="form-control"> </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="hr-line-dashed"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label"> שם משפחה</label>
                                                            <div class="col-sm-10">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="last_name" placeholder="שם משפחה" class="form-control"> </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="hr-line-dashed"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">אימייל</label>
                                                            <div class="col-sm-10">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="email" placeholder="אימייל" class="form-control"> </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="hr-line-dashed"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">טלפון</label>
                                                            <div class="col-sm-10">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="phone" placeholder="טלפון" class="form-control"> </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="hr-line-dashed"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label"> כתובת</label>
                                                            <div class="col-sm-10">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="address" placeholder="כתובת" class="form-control"> </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="hr-line-dashed"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label"> דירוג</label>
                                                            <div class="col-sm-10">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="rank" placeholder="דירוג" class="form-control"> </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="hr-line-dashed"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">קטגוריה</label>
                                                            <div class="col-sm-10 col-md-4">
                                                                <select class="form-control m-b" name="category_id">
                                                                    <?php
                                                                    foreach($categories as $category){
                                                                      $option = '<option value="'.$category['category_id'].'">';
                                                                      $option .= $category['category_name'];
                                                                      $option .= '</option>';
                                                                      echo $option;
                                                                    }
                                                                ?>
                                                                     <optgroup label="המלצות">
                                                                        <?php
                                                                            foreach($reco_categories as $category){
                                                                              $option = '<option value="r_'.$category['category_id'].'">';
                                                                              $option .= $category['category_name'];
                                                                              $option .= '</option>';
                                                                              echo $option;
                                                                        }
                                                                    ?>
                                                                     </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="hr-line-dashed"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">איזור</label>
                                                            <div class="col-sm-10 col-md-4">
                                                                <select class="form-control m-b" name="location">
                                                                    <?php
                                                                    foreach($locations as $location){
                                                                      $option = '<option value="'.$location.'">';
                                                                      $option .= $location;
                                                                      $option .= '</option>';
                                                                      echo $option;                                                                    }
                                                                ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="hr-line-dashed"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label"> מחיר</label>
                                                            <div class="col-sm-10">
                                                                <div class="row"> </div>
                                                                <div class="col-md-4">
                                                                    <input type="number" name="price" placeholder="מחיר" class="form-control"> </div>
                                                            </div>
                                                        </div>
                                                        <div class="hr-line-dashed"></div>
                                                           <div class="form-group">
                                                            <label class="col-sm-2 control-label"> וידאו</label>
                                                            <div class="col-sm-10">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="video_link" placeholder="לינק לוידאו" class="form-control"> </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="hr-line-dashed"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">מומלץ</label>
                                                            <div class="col-sm-10">
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" value="1" name="reco" id="inlineCheckbox1"> a </label>
                                                                <label class="checkbox-inline">
                                                            </div>
                                                        </div>
                                                        <div class="hr-line-dashed"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label"> תקציר</label>
                                                            <div class="col-sm-10">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input type="text" name="desc" placeholder="תקציר" class="form-control"> </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="hr-line-dashed"></div>
                                                        <div class="form-group">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label"> עמוד פייסבוק</label>
                                                            <div class="col-sm-10">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input type="text" name="fb_link" placeholder="לינק לעמוד פייסבוק" class="form-control"> </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="hr-line-dashed"></div>
                                                        <div class="form-group">
                                                            <div class="col-sm-4 col-sm-offset-2">
                                                                <button class="btn btn-primary" type="submit" name="register">הוסף ספק</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>
                    <!-- The template to display files available for upload-->
                    <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                        <tr class="template-upload fade">
                            <td> <span class="preview"></span> </td>
                            <td>
                                <p class="name">{%=file.name%}</p> <strong class="error text-danger"></strong> </td>
                            <td>
                                <p class="size">Processing...</p>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                </div>
                            </td>
                            <td> {% if (!i && !o.options.autoUpload) { %}
                                <button class="btn btn-primary start" disabled> <em class="fa fa-fw fa-upload"></em> <span>Start</span> </button> {% } %} {% if (!i) { %}
                                <button class="btn btn-warning cancel"> <em class="fa fa-fw fa-times"></em> <span>Cancel</span> </button> {% } %} </td>
                        </tr> {% } %} </script>
                    <!-- The template to display files available for download-->
                    <script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                        <tr class="template-download fade">
                            <td> <span class="preview">
													{% if (file.thumbnailUrl) { %}
															<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
													{% } %}
											</span> </td>
                            <td>
                                <p class="name"> {% if (file.url) { %} <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl? 'data-gallery': ''%}>{%=file.name%}</a> {% } else { %} <span>{%=file.name%}</span> {% } %} </p> {% if (file.error) { %}
                                <div><span class="label label-danger">Error</span> {%=file.error%}</div> {% } %} </td>
                            <td> <span class="size">{%=o.formatFileSize(file.size)%}</span> </td>
                            <td> {% if (file.deleteUrl) { %}
                                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}> <em class="fa fa-fw fa-trash"></em> <span>Delete</span> </button> {% } else { %}
                                <button class="btn btn-warning cancel"> <em class="fa fa-fw fa-times"></em> <span>Cancel</span> </button> {% } %} </td>
                        </tr> {% } %} </script>
                    </div>
                    </div>
                    </div>
                    </section>
                    <script type="text/javascript" src="js/jquery.min.js"></script>
                    <script type="text/javascript" src="bootstrap-rtl-master/dist/js/bootstrap-rtl.min.js"></script>
                    <script src="js/metisMenu.min.js"></script>
                    <script src="js/jquery.nanoscroller.min.js"></script>
                    <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
                    <script src="js/pace.min.js"></script>
                    <script src="js/waves.min.js"></script>
                    <script src="js/jquery-jvectormap-world-mill-en.js"></script>
                    <script src="js/file-upload/widget.js"></script>
                    <script src="js/file-upload/tmpl.js"></script>
                    <script src="js/file-upload/load-image.all.min.js"></script>
                    <script src="js/file-upload/canvas-to-blob.js"></script>
                    <script src="js/file-upload/jquery.iframe-transport.js"></script>
                    <script src="js/file-upload/jquery.fileupload.js"></script>
                    <script src="js/file-upload/jquery.fileupload-process.js"></script>
                    <script src="js/file-upload/jquery.fileupload-image.js"></script>
                    <script src="js/file-upload/jquery.fileupload-audio.js"></script>
                    <script src="js/file-upload/jquery.fileupload-video.js"></script>
                    <script src="js/file-upload/jquery.fileupload-validate.js"></script>
                    <script src="js/file-upload/jquery.fileupload-ui.js"></script>
                    <script type="text/javascript" src="js/custom.js"></script>
                    <script src="js/file-upload/custom-upload.js"></script>
            </body>

            </html>
