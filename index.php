
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
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script type="text/javascript" src="js/jquery.min.js"></script>

<link rel="stylesheet" href="css/style.css" type="text/css"  />

<style>
.container.fill {position: relative; top: 20vh;}
#login-btn{background: #003;}
img.logo {margin-bottom: 20px;}
</style>

</head>
<body>
    
    
 <div class="container fill">
            <div class="row">
                <div class="account-col text-center">
                    <img class="logo" src="images/logo.png">
                    <h2>התחברות אדמין</h2>
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
                        <button type="submit" id="login-btn" name="btn-login" class="btn btn-primary btn-block ">התחבר/י</button>
                <p>weddis &copy; 2017</p>
                    </form>
                </div>
            </div>
        </div>



</body>
</html>
