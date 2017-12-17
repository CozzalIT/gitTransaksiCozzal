<?php
include("config.php");
session_start();
$user_check=$_SESSION['login_user'];
$admin = $db->prepare('SELECT * FROM tb_admin WHERE username = :username');
$admin->execute(array(
                  ':username' => $user_check
                  ));
$row = $admin->fetch(PDO::FETCH_ASSOC);

$login_session=$row['username'];

if(!isset($login_session))
{
header("Location: login.php");
}
?>