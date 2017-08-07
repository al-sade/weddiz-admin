<?php
	require_once("session.php");

	if(isset($_SESSION['user_session'])){
		require_once("init.php");
	}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Weddis - Admin</title>

        <!-- Bootstrap -->
        <link href="bootstrap-rtl-master/dist/css/bootstrap-rtl.min.css" rel="stylesheet">
        <link href="css/bootstrap-wysihtml5.css" rel="stylesheet">
        <link href="css/waves.min.css" type="text/css" rel="stylesheet"><link rel="stylesheet" href="css/nanoscroller.css">

      <link href="css/awesome-bootstrap-checkbox.css" rel="stylesheet">
       <link href="css/menu-light.css" type="text/css" rel="stylesheet">
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
				<link rel="stylesheet" href="css/jquery.fileupload.css">


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
