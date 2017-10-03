<?php
require_once('head.php');
$suppliers= $auth_admin->getAllSuppliers();
?>

<?php
if(isset($_POST['submit'])){
    $supplier_id = strip_tags($_POST['supplier_id']);
    $the_couple = strip_tags($_POST['the_couple']);
    $event_date = strip_tags($_POST['event_date']);
    $reco_text = strip_tags($_POST['supplier_id']);
    try{
    $auth_admin->saveTestimonial($supplier_id, $the_couple, $event_date, $reco_text);
    }catch (Exception $e) {
		echo $e->getMessage();
	}
    echo "<meta http-equiv='refresh' content='0'>";
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
                                <label class="col-sm-2 control-label">בחר ספק</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="supplier_id">
                                            <?php
                                                foreach($suppliers as $key => $supplier){
                                                      $option = '<option value="'.$supplier['supplier_id'].'">';                                                      
                                                      $option .= $supplier['first_name'].' '.$supplier['last_name'];
                                                      $option .= '</option>';
                                                      echo $option;
                                                    }
                                            ?>
                                            </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">שם הזוג</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="text" name="the_couple" placeholder="שם הזוג" class="form-control"> </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">תאריך האירוע</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="date" name="event_date" placeholder="תאריך האירוע" class="form-control"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">המלצה</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <textarea type="text" name="reco_text" rows="5" placeholder="כתוב המלצה" class="form-control"> </textarea></div>
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