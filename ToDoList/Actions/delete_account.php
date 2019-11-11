<?php
namespace Auth;
include ("../classes/Register_Login/User.php");
include ("../classes/Register_Login/User_Database.php");
include ("../classes/Register_Login/Task.php");
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../pages/login_page.php");
}?>
<html>
<head>
    <title>Deleting account</title>
    <link rel="stylesheet" type="text/css" href="../pages/styles/ToDoListStyle.css">
</head>
<body>
<?php
$user_database = new User_Database('localhost', 'root', '', 'auth');
$fetched_user=$user_database->query("SELECT password FROM users WHERE username='".$_SESSION['user_id']."'")->fetch_assoc();
if(!password_verify($_POST['password'],$fetched_user['password'])){
    header("Location: ../pages/delete_account_page.php?id=1");
}
else{
    $user_database->query("DELETE FROM tasks WHERE username=\"".$_SESSION['user_id']."\"");//deletes all tasks of the current user
    $user_database->query("DELETE FROM users WHERE username=\"".$_SESSION['user_id']."\"");//deletes current user account
    session_destroy();
    header("Location: ../pages/login_page.php");
}

?>
</body>
</html>