<?php
namespace Auth;
include ("../classes/Register_Login/User.php");
include ("../classes/Register_Login/User_Database.php");
include ("../classes/Register_Login/Task.php");
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../pages/login_page.php");
}

$user_database = new User_Database('localhost', 'root', '', 'auth');
$fetched_user=$user_database->query("SELECT password FROM users WHERE username='".$_SESSION['user_id']."'")->fetch_assoc();
if(empty($_POST["useremail"])||strlen($_POST["useremail"])>40||strlen($_POST["useremail"])<6){
    header("Location: ../pages/change_email_page.php?id=1");
}
else{
    if(!password_verify($_POST['password'],$fetched_user['password'])) {
        header("Location: ../pages/change_email_page.php?id=2");
    }
    else{
        $user_database->query("UPDATE users SET email='".$_POST['useremail']."' WHERE username='".$_SESSION['user_id']."'");
        header("Location: ../pages/ToDoList_page.php?id=8");
    }
}
