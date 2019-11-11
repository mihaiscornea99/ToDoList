<?php
namespace Auth;
include ("../classes/Register_Login/User.php");
include ("../classes/Register_Login/User_Database.php");
include ("../classes/Register_Login/Task.php");
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../pages/login_page.php");
} ?>

<html>
<head>
    <title>Delete account</title>
    <link rel="stylesheet" type="text/css" href="styles/RegisterLoginStyle.css">
</head>
<body>
<br>
<div class="site-title">
    If you are really sure, here you can delete your account!
</div>
<br>
<br>
<br>
<form method="post" action="../Actions/delete_account.php">
    <p><a href="../pages/ToDoList_page.php" class="back_button">Back</a></p>
    <div class="input-group">
        <label>Enter your password to delete account</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Delete account</button>
    </div>
</form>
<?php
if(isset($_GET['id'])){
    switch ($_GET['id']){//The mighty switch of error messages, register.php can redirect to this page, also sending an ID through GET
        case 1:
            echo '<div class="failure">Incorrect password!</div>';
            break;
    }
}

?>

</body>
</html>