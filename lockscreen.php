<?php
require_once('head.php');
 ?>
    <body class="lockscreen">
        <div class="container">
            <div class="row">
                <div class="locksreen-col text-center">
                    <img src="images/avtar-1.jpg" class="img-circle" alt="">
                    <h3><small>Logged In As</small>David Villa</h3>
                    <form class="m-t" role="form" action="index.php">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="******" required="">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block full-width">Unlock</button>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="bootstrap-rtl-master/dist/js/bootstrap-rtl.min.js"></script>
    </body>
</html>
