<?php
session_start();

if(isset($_SESSION['user_id'])){
    header("Location: ../pages/ToDoList_page.php");
} ?>

<html>
<head>
    <title>
        Register
    </title>
    <link rel="stylesheet" type="text/css" href="styles/RegisterLoginStyle.css">
</head>
<body>
<br>
<br>
<div class="site-title">
    Join the "TO DO" community now!
</div>
<br>
<br>
Please, register!
<br>
<br>
<form method="post" action="../Actions/register.php">
    <div class="input-group">
        <label>email address:</label>
        <input type="text" name="useremail">
    </div>
    <div class="input-group">
        <label>username:</label>
        <input type="text" name="username">
    </div>
    <div class="input-group">
        <label>        password:</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <label>confirm password:</label>
        <input type="password" name="password_confirmation">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
    </div>
    <p>
        Already a member? <a href="login_page.php">Sign in</a>
    </p>
</form>
<?php
if(isset($_GET['id'])){
    switch ($_GET['id']){//The mighty switch of error messages, register.php can redirect to this page, also sending an ID through GET
        case 1:
            echo '<div class="failure">Please enter a username!</div>';
            break;
        case 2:
            echo '<div class="failure">Username must be between 6 and 16 characters!</div>';
            break;
        case 3:
            echo '<div class="failure">Please enter a password!</div>';
            break;
        case 4:
            echo '<div class="failure">Password must be between 6 and 16 characters!</div>';
            break;
        case 5:
            echo '<div class="failure">Please confirm your password!</div>';
            break;
        case 6:
            echo '<div class="failure">The passwords provided do not match!</div>';
            break;
        case 7:
            echo '<div class="failure">Username or email already exists!</div>';
            break;
        case 8:
            echo '<div class="failure">Please enter an email address between 6 and 40 characters!</div>';
            break;
        case 9:
            echo '<div class="failure">Email address already registered!</div>';
            break;
    }
}

?>
</body>
</html>
