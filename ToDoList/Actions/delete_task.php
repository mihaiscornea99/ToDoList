<?php
namespace Auth;
include ("../classes/Register_Login/User.php");
include ("../classes/Register_Login/User_Database.php");
include ("../classes/Register_Login/Task.php");

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../pages/login_page.php");
}

$task_id = $_GET['id'];
$task_database=new User_Database('localhost', 'root', '', 'auth');


$haxxor_check=$task_database->query('SELECT username FROM tasks WHERE id='.$task_id);//This checks if someone's sneaky and tries deleting someone else's tasks
if($_SESSION['user_id']==$haxxor_check->fetch_assoc()['username']){
    $task_database->query('DELETE FROM tasks WHERE id='.$task_id);//deleting a task of a given ID
    header('Location: ../pages/ToDoList_page.php?id=5');
}
else{
    header('Location: ../pages/ToDoList_page.php');
}