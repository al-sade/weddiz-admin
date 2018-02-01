<?php
require_once('head.php');

function getCategory($supplier, $categories) {
    for ($i = 0; $i < count($categories); $i++){
        if(array_search($supplier['category_id'], $categories[$i])){
            return $categories[$i]['category_name'];
        }
    }
    return false;
}

if(isset($_GET['r_sid'])){
   $supplier_id = $_GET['r_sid'];
   $supplier = $auth_admin->getRecoSupplier($supplier_id); 
}else{
   $supplier_id = $_GET['sid'];
   $supplier = $auth_admin->getSupplier($supplier_id);
}

$categories = $auth_admin->getCategories();
$supplier['category_name'] = getCategory($supplier, $categories);

$supplier_name = $supplier['first_name'].' '.$supplier['last_name'];
$supplier_pic = LOCALIMG . $supplier['profile_pic'] ;

$stats = $auth_admin->getSupplierStats($supplier_id);

if (isset($_POST['update'])){
    $supplier_data['supplier_id'] = $supplier_id;
    $supplier_data['first_name'] = strip_tags($_POST['first_name']);
    $supplier_data['last_name'] = strip_tags($_POST['last_name']);
	$supplier_data['email'] = strip_tags($_POST['email']);
	$supplier_data['phone'] = strip_tags($_POST['phone']);
	$supplier_data['category'] = strip_tags($_POST['category']);
	$supplier_data['location'] = strip_tags($_POST['location']);
	$supplier_data['price'] = strip_tags($_POST['price']);
	$supplier_data['video_link'] = strip_tags($_POST['video_link']);
	$supplier_data['address'] = strip_tags($_POST['address']);
	$supplier_data['description'] = strip_tags($_POST['description']);

    $auth_admin->updateSupplier($supplier_data);
    echo "<meta http-equiv='refresh' content='0'>";

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
                                        <!-- <h1>My Profile <small></small></h1> -->
                                        <ol class="breadcrumb">
                                            <li><a href="#"><i class="fa fa-home"></i></a></li>
                                            <li class="active">פרופיל ספק</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <!-- end .page title-->

                            <!-- Start Profile Data -->

                            <div class="col-md-4 margin-b-30">
                                <div class="profile-overview">
                                    <div class="avtar text-center"> <img src="<?php echo $supplier_pic ?>" alt="" class="img-thumbnail">
                                        <h3><?php echo $supplier_name ?></h3>
                                        <hr>
                                        <ul class="socials list-inline">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>
                                        <hr> </div>
                                    <table class="table profile-detail table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="3">mפרטי התקשרות</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>לינק</td>
                                                <td> <a target="_blank" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/weddis/supplier.php?sid='.$supplier['supplier_id']; ?>">
                                        עמוד ספק
                                    </a></td>
                                            </tr>
                                        <tr>
                                                <td>וידאו</td>
                                                <td>
                                                    <a target="_blank" href="<?php echo $supplier['video_link'] ?>" target="_blank">נגן סרטון</a>
                                                </td>
                                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>מומלץ</td>
                                                <td>
                                                    <?php if($supplier['reco']){ ?>
                                                    <span class="label label-sm label-info"><i class="glyphicon glyphicon-star" data-value="2"></i></span>
                                                        <?php }else{ ?>
                                                    <span class="label label-sm label-info"><i class="glyphicon glyphicon-star-empty" data-value="2"></i></span>
                                                            <?php } ?>
                                                </td>
                                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                                      
                            <!-- End Profile Data -->

                            <!-- Start Profile Form -->

                            <div class="col-md-5 margin-b-30">
                                <div class="profile-edit">
                                    <form class="form-horizontal update-sup" method="post">
                                        <h4 class="mb-xlg">פרטים</h4>
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">שם פרטי</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="first_name" value="<?php echo $supplier['first_name'] ?>"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">שם משפחה</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="last_name" value="<?php echo $supplier['last_name'] ?>"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">eMail</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="email" value="<?php echo $supplier['email'] ?>"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">טלפון</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="phone" value="<?php echo $supplier['phone'] ?>"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">קטגוריה</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="category" value="<?php echo $supplier['category_name'] ?>"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">מיקום</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="location" value="<?php echo $supplier['location'] ?>"> </div>
                                            </div>
                                                                                        <div class="form-group">
                                                <label class="col-md-3 control-label">מחיר</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="price" value="<?php echo $supplier['price'] ?>"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">וידאו</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="video_link" value="<?php echo $supplier['video_link'] ?>"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">כתובת</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="address" value="<?php echo $supplier['address'] ?>"> </div>
                                            </div>
                                        </fieldset>
                                        <hr class="dotted tall">
                                        <h4 class="mb-xlg">תקציר</h4>
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">תיאור הספק</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" rows="8" name="description" placeholder="<?php echo $supplier['desc'] ?>"></textarea>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-md-9 col-md-offset-3">
                                                    <button type="submit" class="btn btn-primary" name="update">עדכן</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        <!-- End Profile Form -->
                            
                            <div class="col-md-3">
                                <div class="profile-states">
                                    <h3>נתונים</h3>
                                    <a class="wadmin-nav" href="supplier-albums.php?sid=<?php echo $supplier_id ?>">
                                        <div class="sale-state-box">
                                            <h3><?php echo $stats['album'][0]['album'];?></h3> <span>אלבומים</span> </div></a>
                                        <div class="sale-state-box">
                                    
                                        <h3>654</h3> <span>פניות</span> </div>
                                    <div class="sale-state-box">
                                        <h3>79</h3> <span>חוזים</span> </div>
                                    <div class="sale-state-box">
                                        <h3><?php echo $stats['testimonials'][0]['testimonials'];?></h3> <span>המלצות</span> </div>
                                </div>
                                <div class="recent-activities">
                                    <h3>אירועים אחרונים</h3>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#"> <img class="media-object" src="images/avtar-1.jpg" alt="..."> </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading"> שי ולירז</h4> 12/02/2016 </div>
                                    </div>
                                    <!--media-->
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#"> <img class="media-object" src="images/avtar-2.jpg" alt="..."> </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">מיכל ואלון</h4> 15/03/2016 </div>
                                    </div>
                                    <!--media-->
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#"> <img class="media-object" src="images/avtar-3.jpg" alt="..."> </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading"> ענת ויותם</h4> 01/01/2017 </div>
                                    </div>
                                    <!--media-->
                                </div>
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
            <!--<script src="js/jquery.nanoscroller.min.js"></script>-->
            <script type="text/javascript" src="js/custom.js"></script>
            <!--supplier video player-->
        
    </body>

    </html>
