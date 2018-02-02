<?php require_once('head.php'); ?>

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
                                <h1>Calendar<small></small></h1>
                                <ol class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                    <li class="active">לוח שנה</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- end .page title-->


                    <div class="row">
                        <div class="col-md-12">
                            <div id='calendar'></div>

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div> 
            </div>
        </section>

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="bootstrap-rtl-master/dist/js/bootstrap-rtl.min.js"></script>
        <script src="js/metisMenu.min.js"></script><script src="js/jquery.nanoscroller.min.js"></script>
        <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/waves.min.js"></script>
        <script src="js/jquery-jvectormap-world-mill-en.js"></script>
        <!--        <script src="js/jquery.nanoscroller.min.js"></script>-->
        <script type="text/javascript" src="js/custom.js"></script>
        <!--full calendar plugin-->
        <script src="js/fullcalendar/moment.min.js"></script>
        <script src="js/fullcalendar/jquery-ui.custom.min.js"></script>
        <script src="js/fullcalendar/fullcalendar.min.js"></script>
        <script src="js/fullcalendar-custom.js"></script>

    </body>
</html>
