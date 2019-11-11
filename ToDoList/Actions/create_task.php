<?php namespace Auth;
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../pages/login_page.php");
}?>

<html>
    <head>
        <title>
            Registering
        </title>
        <link rel="stylesheet" type="text/css" href="../pages/styles/RegisterLoginStyle.css">
    </head>
    <body>
<?php
include ("../classes/Register_Login/User.php");
include ("../classes/Register_Login/User_Database.php");
include ("../classes/Register_Login/Task.php");
$backButton = "<br><input type=\"submit\"class=\"btn\" value=\"Back\" <a href=\"#\" onclick=\"history.back();\"></a>";
if (empty($_POST["taskname"])) {
    header('Location: ../pages/ToDoList_page.php?id=1');
} else {
    if(strlen($_POST['taskname'])>100){
        header("Location: ../pages/ToDoList_page.php?id=2'");
    } else {
        if (empty($_POST["taskdeadline"])) {
            header("Location: ../pages/ToDoList_page.php?id=3");
        }
        else {
            date_default_timezone_set("Europe/Bucharest");
            $deadline = new \DateTime($_POST["taskdeadline"]);
            $current_time = new \DateTime();
            $task = new Task(0,$_SESSION['user_id'], $_POST["taskname"], $deadline, $current_time);
            $task_database=new User_Database('localhost', 'root', '', 'auth');
            $task->push_to_db($task_database);
            header("Location: ../pages/ToDoList_page.php?id=4");
        }
        }
    }
?>

    </body>
</html>

