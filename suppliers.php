
	<?php
	require_once("session.php");
	require_once('head.php');

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
                                <h1>Calendar<small></small></h1>
                                <ol class="breadcrumb">
                                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                                    <li class="active">Calendar</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- end .page title-->


                    <div class="row">
                        <div class="col-md-9">
                            <div id='calendar'></div>

                            <div class="clearfix"></div>

                        </div>
                        <div class="col-md-3">
                            <div id='external-events'>
                                <h4>Draggable Events</h4>
                                <div class='fc-event'>My Event 1</div>
                                <div class='fc-event'>My Event 2</div>
                                <div class='fc-event'>My Event 3</div>
                                <div class='fc-event'>My Event 4</div>
                                <div class='fc-event'>My Event 5</div>
                                <p>
                                    <input type='checkbox' id='drop-remove' />
                                    <label for='drop-remove'>remove after drop</label>
                                </p>
                            </div>

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
        <!-- Google Analytics:  -->
        <script>
            (function (i, s, o, g, r, a, m)
            {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function ()
                {
                    (i[r].q = i[r].q || []).push(arguments);
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-3560057-28', 'auto');
            ga('send', 'pageview');
        </script>
    </body>
</html>
