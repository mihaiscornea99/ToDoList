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
    <title>Change email address</title>
    <link rel="stylesheet" type="text/css" href="styles/RegisterLoginStyle.css">
</head>
<body>
<br>
<div class="site-title">
    Here you can change your email address!
</div>
<br>
<br>
<br>
<form method="post" action="../Actions/change_email_address.php">
    <p><a href="../pages/ToDoList_page.php" class="back_button">Back</a></p>
    <div class="input-group">
        <label>New email address:</label>
        <input type="text" name="useremail">
    </div>
    <div class="input-group">
        <label>Please enter your password:</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Change email address!</button>
    </div>
</form>
<?php
if(isset($_GET['id'])){
    switch ($_GET['id']){//The mighty switch of error messages, register.php can redirect to this page, also sending an ID through GET
        case 1:
            echo '<div class="failure">Please enter an email address between 6 and 40 characters!</div>';
            break;
        case 2:
            echo '<div class="failure">Incorrect password!</div>';
            break;
    }
}

?>

</body>
</html>
