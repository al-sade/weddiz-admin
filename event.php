<?php
require_once('head.php');

$status_arr = $auth_admin->getEventStatusList();

$event_id = $_GET['eid'];
$event = $auth_admin->getEvent($event_id);
$event_suppliers = $auth_admin->getEventSuppliers($event['suppliers']);
$cur_status= $auth_admin->getEventStatus($event_id);

if(isset($_POST['update_status'])){
    $new_status = strip_tags($_POST['new_status']);
    try{
    $auth_admin->updateEventStatus($event_id, $new_status);
    }catch (Exception $e) {
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
                                    <div class="avtar text-center">
                                        <h3 style="text-align: right;">סטטוס: </h3>
                                        <form method="post" class="form-horizontal">
                                            <select class="form-control m-b" name="new_status">
                                            <?php
                                                foreach($status_arr as $key => $status){
                                                      if(!strcmp($cur_status,$key)){
                                                      $option = '<option value="'.$key.'" selected>';
                                                      }else{
                                                        $option = '<option value="'.$key.'">';
                                                      }
                                                      $option .= $status_arr[$key]['status_name'];
                                                      $option .= '</option>';
                                                      echo $option;
                                                    }
                                            ?>
                                            </select>
                                            <button class="btn btn-primary" type="submit" name="update_status">עדכן</button>
                                        </form>
                                        <hr>
                                        <h3 style="text-align: right;"><?php echo $event['contact_name'] ?></h3>
                                        <hr> </div>
                                    <table class="table profile-detail table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="3">
                                                    <h2>פרטי התקשרות</h2></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>email:</td>
                                                <td>
                                                    <a href="mailto:<?php echo $event['contact_mail'] ?>">
                                                        <?php echo $event['contact_mail']; ?>
                                                    </a>
                                                </td>
                                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>phone:</td>
                                                <td>
                                                    <?php echo $event['contact_phone']; ?>
                                                </td>
                                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>תאריך</td>
                                                <td>
                                                    <?php echo $event['event_date']; ?>
                                                </td>
                                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>הודעה</td>
                                                <td>
                                                    <?php echo $event['message']; ?>
                                                </td>
                                                <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                                                        <!-- end .page title-->

                            <div class="col-md-5 margin-b-30">
                                <div class="profile-edit">
                                    <h2 class="mb-xlg">ספקים שנבחרו</h2>
                                    <hr>
                                    <?php 
                                    foreach($event_suppliers as $supplier){ 
                                    $supplier_name = $supplier['first_name'].' '.$supplier['last_name'];
                                    ?>
                                        <h3 class="mb-xlg"><a href="supplier.php?sid=<?php echo $supplier['supplier_id'] ?>">
                                        <?php echo $supplier_name ?>
                                    </a></h3>
                                        <table class="table profile-detail table-condensed table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>email:</td>
                                                    <td>
                                                        <a href="mailto:<?php echo $event['contact_mail'] ?>">
                                                            <?php echo $event['contact_mail']; ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="#panel_edit_account" class="show-tab"></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>phone:</td>
                                                    <td>
                                                        <?php echo $event['contact_phone']; ?>
                                                    </td>
                                                    <td>
                                                        <a href="#panel_edit_account" class="show-tab"></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="profile-states">
                                    <h3>נתונים</h3>
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
            <!--        <script src="js/jquery.nanoscroller.min.js"></script>-->
            <script type="text/javascript" src="js/custom.js"></script>
    </body>

    </html>