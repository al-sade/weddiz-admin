<?php require_once('head.php'); ?>

<?php
if(isset($_POST['submit'])){
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
    <?php include('includes/sidebar.php');?>
        <div id="wrapper">
            <div class="content-wrapper container">
                <div class="row">
                    <div class="col-sm-8">
                        <section class="page">
                            <form method="post" class="form-horizontal">
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
                                    <label class="col-sm-2 control-label">טלפון</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="text" name="phone" placeholder="טלפון" class="form-control"> </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit" name="submit">הוספה</button>

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