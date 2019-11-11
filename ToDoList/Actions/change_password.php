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
if(!password_verify($_POST['password'],$fetched_user['password'])){
    header("Location: ../pages/change_password_page.php?id=1");
}
    else{
        if(empty($_POST['new_password'])){
            header("Location: ../pages/change_password_page.php?id=2");
        }
        else{
            if(strlen($_POST['new_password'])>16||strlen($_POST['new_password'])<6){
                header("Location: ../pages/change_password_page.php?id=3");
            }
            else{
                if(password_verify($_POST['new_password'],$fetched_user['password'])){
                    header("Location: ../pages/change_password_page.php?id=4");
                }
                else {
                    if(empty($_POST['new_password_confirmation'])){
                        header("Location: ../pages/change_password_page.php?id=5");
                    }
                    else{
                        if(!($_POST['new_password']==$_POST['new_password_confirmation'])){
                            header("Location: ../pages/change_password_page.php?id=6");
                        }
                        else{
                            $user_database->query("UPDATE users SET password='".password_hash($_POST['new_password'],PASSWORD_DEFAULT)."' WHERE username='".$_SESSION['user_id']."'");
                            header("Location: ../pages/ToDoList_page.php?id=7");
                        }
                    }
                }
            }
        }
    }
