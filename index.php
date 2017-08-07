
<?php
session_start();
require_once(__DIR__.'/classes/Admin.php');

$admin = new ADMIN();

if($admin->is_loggedin()!="")
{
	$admin->redirect('dashboard.php');
}

if(isset($_POST['btn-login']))
{
	$user_name = strip_tags($_POST['user_name']);
	$pass = strip_tags($_POST['password']);

	if($admin->doLogin($user_name,$pass)){
		$admin->redirect('dashboard.php');
	}	else {
		$error = "Wrong Details !";
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RollCall : Login</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css"  />
</head>
<body>
    
    
 <div class="container">
            <div class="row">
                <div class="account-col text-center">
                    <h1>WEDDIS</h1>
                    <h3>התחברות אדמין</h3>
                    <form class="m-t" role="form" method="post" id="login-form">
                        <div id="error">
                            <?php
                                if(isset($error))
                                {
                                    ?>
                                    <div class="alert alert-danger">
                                       <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="form-group">
                        <input type="text" class="form-control" name="user_name" placeholder="שם משתמש" required />
                        <span id="check-e"></span>
                        </div>

                        <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="סיסמה" />
                        </div>
                        <button type="submit" name="btn-login" class="btn btn-primary btn-block ">Login</button>
                        <a href="#"><small>שכחת סיסמה?</small></a>
                <p>weddis &copy; 2016</p>
                    </form>
                </div>
            </div>
        </div>



</body>
</html>
