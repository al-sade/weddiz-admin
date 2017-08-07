<?php
require_once './classes/Admin.php';

$auth_admin = new ADMIN();

$admin_id = $_SESSION['user_session'];

$stmt = $auth_admin->runQuery("SELECT * FROM w_admins WHERE admin_id=:admin_id");
$stmt->execute(array(":admin_id"=>$admin_id));

$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

 ?>
