<?php
namespace Auth;
include ("../classes/Register_Login/User.php");
include ("../classes/Register_Login/User_Database.php");
include ("../classes/Register_Login/Task.php");
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../pages/login_page.php");
}

$database=new User_Database('localhost', 'root', '', 'auth');
$sendmails=$database->query("SELECT send_mails FROM users WHERE username='".$_SESSION['user_id']."'")->fetch_assoc()['send_mails'];
if($sendmails==1){
    $database->query("UPDATE users SET send_mails=0 WHERE username='".$_SESSION['user_id']."'");
}
else{
    $database->query("UPDATE users SET send_mails=1 WHERE username='".$_SESSION['user_id']."'");
}
header("Location: ../pages/login_page.php");
