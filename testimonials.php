<!DOCTYPE html>
<html dir="rtl">
<?php 
require_once('head.php');
?>
    </head>

    <body>
        <!-- Fixed navbar -->
        <?php require_once('header.php')?>
            <!-- Main Screen Section -->
    <?php include('includes/sidebar.php');?>
        <div id="wrapper">
            <div class="content-wrapper container">
                <div class="row">
                    <div class="col-sm-12">
                        <section class="page">
                            <form method="post" enctype="multipart/form-data">
                                <table width="100%">
                                    <tr>
                                        <td>Select Photo (one or multiple):</td>
                                        <td>
                                            <input type="file" name="files[]" multiple/> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">Note: Supported image format: .jpeg, .jpg, .png, .gif</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <input type="submit" name="create" value="Create Gallery" id="selectedButton" /> </td>
                                    </tr>
                                </table>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    
            <script src="assets/js/bootstrap-rating-input.min.js"></script>
            <script src="assets/js/slick.min.js"></script>
            <script src="assets/js/jquery.viewbox.min.js"></script>
            <script src="assets/js/script.js"></script>
            <script type="text/javascript" src="assets/js/wishlist.js"></script>
</body>

</html>