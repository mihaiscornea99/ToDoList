<?php
session_start();

if(isset($_SESSION['user_id'])){
    header("Location: ../pages/ToDoList_page.php");
} ?>

<html>
<head>
    <title>
        Login
    </title>
    <link rel="stylesheet" type="text/css" href="styles/RegisterLoginStyle.css">
</head>
<body>
<br>
<br>
<div class="site-title">
    Welcome to the sketchiest TO-DO list on the internet!
</div>
<br>
<br>
Please, log in!
<br>
<br>
<form method="post" action="../Actions/login.php">
    <div class="input-group">
        <label>username:</label>
        <input type="text" name="username">
    </div>
    <div class="input-group">
        <label>        password:</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">login</button>
    </div>
    <p>
        Not a member? <a href="register_page.php">Register now</a>
    </p>
</form>
<?php
if(isset($_GET['id'])){
    switch ($_GET['id']){//another switch of error messages, login.php can redirect to this page, sending error messages through id in GET
        case 1:
            echo '<div class="failure">Please enter a user name!</div>';
            break;
        case 2:
            echo '<div class="failure">Please enter a password!</div>';
            break;
        case 3:
            echo '<div class="success">Account created successfully!<br>You can now log in!</div>';
            break;
        case 4:
            echo '<div class="failure">Wrong username or password!</div>';
            break;

    }
}
?>

</body>
</html>
