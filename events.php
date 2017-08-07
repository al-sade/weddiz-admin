<?php
require_once('head.php');
$events= $auth_admin->getAllEvents();
$status_arr = $auth_admin->getEventStatusList();

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
                                <h1>אירועים <small></small></h1>
                                <ol class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                    <li class="active">רשימת אירועים</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- end .page title-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-card ">
                                <!-- Start .panel -->
                                <div class="panel-body">
                                    <table id="basic-datatables" class="table table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>שם</th>
                                                <th>תאריך</th>
                                                <th>eMail</th>
                                                <th>טלפון</th>
                                                <th>התקבל</th>
                                                <th>סטטוס</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                              foreach($events as $event){
                                                $status = $event['status'];
                                                  if(!$status){ //if new
                                                    $output = '<tr class="table-active">';  
                                                  }else{
                                                    $output = '<tr>';  
                                                  }
                                                $output .= '<td><a href="event.php?eid='.$event['event_id'].'">'.$event['contact_name'].'</a></td>';
                                                $output .= '<td>'.$event['event_date'].'</td>';
                                                $output .= '<td>'.$event['contact_mail'].'</td>';
                                                $output .= '<td>'.$event['contact_phone'].'</td>';
                                                $output .= '<td>'.$event['submission_date'].'</td>';                                                  
                                                $output .= '<td class="table-danger">'.$status_arr[$event['status']]['status_name'].'</td>';
                                                $output .= '</tr>';
                                                echo $output;
                                              }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- End .panel -->
                        </div><!--end .col-->
                    </div><!--end .row-->


                </div>
            </div>
        </section>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="bootstrap-rtl-master/dist/js/bootstrap-rtl.min.js"></script>
        <script src="js/metisMenu.min.js"></script><script src="js/jquery.nanoscroller.min.js"></script>
        <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/jquery-jvectormap-world-mill-en.js"></script>
        <script src="js/data-tables/jquery.dataTables.js"></script>
        <script src="js/data-tables/dataTables.tableTools.js"></script>
        <script src="js/data-tables/dataTables.bootstrap.js"></script>
        <script src="js/data-tables/dataTables.responsive.js"></script>
         <script src="js/waves.min.js"></script>
        <!--        <script src="js/jquery.nanoscroller.min.js"></script>-->
        <script type="text/javascript" src="js/custom.js"></script>
         <script src="js/data-tables/tables-data.js"></script>

        
    </body>
</html>
