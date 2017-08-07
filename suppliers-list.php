<?php
require_once('head.php');
$suppliers= $auth_admin->getAllSuppliers();

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
                                <h1>ספקים <small></small></h1>
                                <ol class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                    <li class="active">רשימת ספקים</li>
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
                                                <th>eMail</th>
                                                <th>קטגוריה</th>
                                                <th>טלפון</th>
                                                <th>דירוג</th>
                                                <th>מיקום</th>
                                                <th>מחיר</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                              foreach($suppliers as $supplier){
                                                $output = '<tr>';
                                                $output .= '<td><a href="supplier.php?sid='.$supplier['supplier_id'].'">';
                                                $output .= $supplier['first_name'].' '.$supplier['last_name'].'</a></td>';
                                                $output .= '<td><a href="mailto:'.$supplier['email'].'">'.$supplier['email'].'</a></td>';
                                                $output .= '<td>'.$supplier['category_name'].'</td>';
                                                $output .= '<td>'.$supplier['phone'].'</td>';
                                                $output .= '<td>'.$supplier['rank'].'</td>';
                                                $output .= '<td>'.$supplier['location'].'</td>';
                                                $output .= '<td>'.$supplier['price'].'</td>';
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

<!--        <script type="text/javascript" src="/assets/js/jquery-2.2.4.min.js"></script>-->
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
