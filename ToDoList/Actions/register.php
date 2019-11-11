<?php namespace Auth; ?>

<?php
session_start();

if(isset($_SESSION['user_id'])){
    header("Location: ../pages/ToDoList_page.php");
} ?>
<html>
<head>
    <title>
        Registering
    </title>
    <link rel="stylesheet" type="text/css" href="../pages/styles/RegisterLoginStyle.css">
</head>

<?php
include ("../classes/Register_Login/User.php");
include ("../classes/Register_Login/User_Database.php");

$backButton = "<br><input type=\"submit\" class=\"btn\" value=\"Back\" <a href=\"#\" onclick=\"history.back();\"></a>";

//A bunch of error checks, redirecting to the register page, sending some error IDs in order to display proper error messages
if(empty($_POST["useremail"])||strlen($_POST["useremail"])>40||strlen($_POST["useremail"])<6){
    header("Location: ../pages/register_page.php?id=8");
}
else{
    if (empty($_POST["username"])) {//username not entered
        header("Location: ../pages/register_page.php?id=1");
    } else {
        if (strlen($_POST["username"])<6||strlen($_POST["username"])>16) {//username entered of invalid dimension
            header("Location: ../pages/register_page.php?id=2");
        } else {
            if (empty($_POST["password"])) {//password not entered
                header("Location: ../pages/register_page.php?id=3");
            } else {
                if (strlen($_POST["password"])<6||strlen($_POST["password"])>16) {//password entered of invalid dimension
                    header("Location: ../pages/register_page.php?id=4");
                } else {
                    if(empty($_POST["password_confirmation"])){//password confirmation not entered
                        header("Location: ../pages/register_page.php?id=5");
                    }
                    else{
                        if(!($_POST["password"] == $_POST["password_confirmation"])){//password and password confirmation
                            header("Location: ../pages/register_page.php?id=6");
                        }
                        else{
                            $user = new User($_POST["useremail"], strtolower($_POST["username"]), $_POST["password"],0);//creating an user object
                            $user_database = new User_Database('localhost', 'root', '', 'auth');
                            $check=$user->register($user_database);
                            echo "I got here 3";
                            switch ($check) {//registration function returning 0 if user already exists
                                case -1:
                                    header("Location: ../pages/register_page.php?id=9");//handling if user already exists
                                    break;
                                case 0:
                                header("Location: ../pages/register_page.php?id=7");//handling if user already exists
                                break;
                                case 1:
                                header("Location: ../pages/login_page.php?id=3");//yay everything worked, redirect to login page
                                break;
                            }
                        }
                    }
                }
            }
        }
    }
}?>
</html>
