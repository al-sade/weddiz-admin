<?php
require_once('head.php');

if(isset($_GET['r_sid'])){
   $supplier_id = $_GET['r_sid'];
   $supplier = $auth_admin->getRecoSupplier($supplier_id); 
   $cat_name = $auth_admin->getRecoCategoryName($supplier['category_id']);
}else{
   $supplier_id = $_GET['sid'];
   $supplier = $auth_admin->getSupplier($supplier_id);
   $cat_name = $auth_admin->getCategoryName($supplier['category_id']);
}

$supplier_name = $supplier['first_name'].' '.$supplier['last_name'];
$supplier_pic = LOCALIMG . $supplier['profile_pic'] ;
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
                                        <h1>My Profile <small></small></h1>
                                        <ol class="breadcrumb">
                                            <li><a href="#"><i class="fa fa-home"></i></a></li>
                                            <li class="active">פרופיל ספק</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <!-- end .page title-->
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
                                            <li><a href="#"><i class="fa fa-github"></i></a></li>
                                        </ul>
                                        <hr> </div>
                                    <table class="table profile-detail table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="3">פרטי התקשרות</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>לינק</td>
                                                <td> <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/weddis/supplier.php?sid='.$supplier['supplier_id']; ?>">
                                        עמוד ספק
                                    </a></td>
                                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>email:</td>
                                                <td>
                                                    <a href="mailto:<?php echo $supplier['email'] ?>">
                                                        <?php echo $supplier['email']; ?>
                                                    </a>
                                                </td>
                                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>phone:</td>
                                                <td>
                                                    <?php echo $supplier['phone']; ?>
                                                </td>
                                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table profile-detail table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="3">מידע כללי</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>קטגוריה</td>
                                                <td>
                                                    <?php echo $cat_name['category_name']; ?>
                                                </td>
                                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>מיקום</td>
                                                <td>
                                                    <?php echo $supplier['location'] ?>
                                                </td>
                                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>מחיר</td>
                                                <td>
                                                    <?php echo $supplier['price'] ?>
                                                </td>
                                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>וידאו</td>
                                                <td>
                                                    <a href="<?php echo $supplier['video_link'] ?>" target="_blank">נגן סרטון</a>
                                                </td>
                                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>כתובת</td>
                                                <td>
                                                    <a href="#">
                                                        <?php echo $supplier['address'] ?>
                                                    </a>
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
                            <div class="col-md-5 margin-b-30">
                                <div class="profile-edit">
                                    <form class="form-horizontal" method="get">
                                        <h4 class="mb-xlg">עדכון פרטים</h4>
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="profileFirstName">שם פרטי</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="profileFirstName"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="profileLastName">שם משפחה</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="profileLastName"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="profileAddress">כתובת</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="profileAddress"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="profileCompany">טלפון</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="profileCompany"> </div>
                                            </div>
                                        </fieldset>
                                        <hr class="dotted tall">
                                        <h4 class="mb-xlg">תקציר</h4>
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="profileBio">תיאור הספק</label>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" rows="3" id="profileBio"></textarea>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-md-9 col-md-offset-3">
                                                    <button type="submit" class="btn btn-primary">עדכן</button>
                                                    <button type="reset" class="btn btn-default">אפס</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-3">
                                <div class="profile-states">
                                    <h3>נתונים</h3>
                                    <a class="wadmin-nav" href="supplier-albums.php?sid=<?php echo $supplier_id ?>">
                                        <div class="sale-state-box">
                                            <h3>3</h3> <span>אלבומים</span> </div></a>
                                        <div class="sale-state-box">
                                    
                                        <h3>654</h3> <span>פניות</span> </div>
                                    <div class="sale-state-box">
                                        <h3>79</h3> <span>חוזים</span> </div>
                                    <div class="sale-state-box">
                                        <h3>16</h3> <span>המלצות</span> </div>
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
