<?php
namespace Auth;
include ("../classes/Register_Login/User.php");
include ("../classes/Register_Login/User_Database.php");
include ("../classes/Register_Login/Task.php");
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../pages/login_page.php");
}


if(isset($_GET['editid'])){
    $task_database=new User_Database('localhost', 'root', '', 'auth');
    $edit_id=$_GET['editid'];
    $task_from_db=$task_database->query("SELECT id,username,taskname,deadline,created_on FROM tasks WHERE id='$edit_id'");
    $task_to_edit=$task_from_db->fetch_assoc();

    if($_SESSION['user_id']==$task_to_edit['username']){
        if (empty($_POST["taskname"])) {
            header('Location: ../pages/ToDoList_page.php?editid='.$_GET['editid'].'&id=1');
        } else {
            if(strlen($_POST['taskname'])>100){
                header('Location: ../pages/ToDoList_page.php?editid='.$_GET['editid'].'&id=2');
            } else {
                if(!empty($_POST['taskdeadline'])){
                    $deadline=new \DateTime($_POST['taskdeadline']);
                }
                else{
                    $deadline=new \DateTime($task_to_edit['deadline']);
                }
                $task_database->query("UPDATE tasks SET taskname='".$_POST['taskname']."', deadline='".$deadline->format('Y-m-d H:i:s')."' WHERE id=".$edit_id);
                header('Location: ../pages/ToDoList_page.php?id=6');
            }
        }
    }
    else{
        header('Location: ../pages/ToDoList_page.php');
    }
}
else{
    header('Location: ../pages/ToDoList_page.php');
}




