<?php
require_once('head.php');
$testimonials = $auth_admin->getAllTestimonials();
?>

<?php
if(isset($_POST['testimonial_id'])){
    $testimonial_id = strip_tags($_POST['testimonial_id']);
    $auth_admin->deleteTestimonial($testimonial_id);
    echo "<meta http-equiv='refresh' content='0'>";
}
?>
<body>
<!-- Static navbar -->

<?php include('includes/header.php'); ?>
<section class="page">

    <?php include('includes/sidebar.php'); ?>

    <div id="wrapper">

        <div class="content-wrapper container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h1>ספקים
                            <small></small>
                        </h1>
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
                                    <th>שם הממליץ</th>
                                    <th>שם הספק</th>
                                    <th>תאריך אירוע</th>
                                    <th>התקבל ב</th>
                                    <th>תוכן</th>
                                    <th>מחק</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($testimonials as $testimonial) {
                                    $supplier_name = $testimonial['first_name'] . ' ' . $testimonial['last_name'];
                                    $output = '<tr>';
                                    $output .= '<td>' . $testimonial['testimonial_name'] . '</td>';
                                    $output .= '<td><a href="supplier.php?sid=' . $testimonial['supplier_id'] . '">' . $supplier_name . '</a></td>';
                                    $output .= '<td>' . $testimonial['event_date'] . '</td>';
                                    $output .= '<td>' . $testimonial['submit_date'] . '</td>';
                                    $output .= '<td>' . $testimonial['text'] . '</td>';
                                    $output .= '<td><form method="post">';
                                    $output .= '<button class="delete-button" type="submit" name="testimonial_id"  value="' . $testimonial['testimonial_id'] . '">';
                                    $output .= 'מחק</button></form></td>';
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
<script src="js/metisMenu.min.js"></script>
<script src="js/jquery.nanoscroller.min.js"></script>
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
