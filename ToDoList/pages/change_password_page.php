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
    <title>Change password</title>
    <link rel="stylesheet" type="text/css" href="styles/RegisterLoginStyle.css">
</head>
<body>
<br>
<div class="site-title">
    Here you can change your password!
</div>
<br>
<br>
<br>
<form method="post" action="../Actions/change_password.php">
    <p><a href="../pages/ToDoList_page.php" class="back_button">Back</a></p>
    <div class="input-group">
        <label>current password:</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <label>new password:</label>
        <input type="password" name="new_password">
    </div>
    <div class="input-group">
        <label>confirm new password:</label>
        <input type="password" name="new_password_confirmation">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Change password</button>
    </div>
</form>
<?php
if(isset($_GET['id'])){
    switch ($_GET['id']){//The mighty switch of error messages, register.php can redirect to this page, also sending an ID through GET
        case 1:
            echo '<div class="failure">Current password incorrect!</div>';
            break;
        case 2:
            echo '<div class="failure">New password not set!</div>';
            break;
        case 3:
            echo '<div class="failure">New password must be between 6 and 16 characters!</div>';
            break;
        case 4:
            echo '<div class="failure">New password can\'t be identical to old password!</div>';
            break;
        case 5:
            echo '<div class="failure">New password confirmation not set!</div>';
            break;
        case 6:
        echo '<div class="failure">New password and confirmation do not match!</div>';
        break;
    }
}

?>

</body>
</html>