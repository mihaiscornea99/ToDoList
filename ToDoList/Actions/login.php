<?php namespace Auth; ?>

<?php
session_start();

if(isset($_SESSION['user_id'])){
    header("Location: ../pages/ToDoList_page.php");
} ?>
<html>
<head>
    <title>
        Logging in
    </title>
    <link rel="stylesheet" type="text/css" href="../pages/styles/RegisterLoginStyle.css">
</head>
<body>
<?php
include ("../classes/Register_Login/User.php");
include ("../classes/Register_Login/User_Database.php");

//$backButton = "<br><input type=\"submit\"class=\"btn\" value=\"Back\" <a href=\"#\" onclick=\"history.back();\"></a>";


//Error checks redirecting to the login page with the corresponding error ID
if (empty($_POST["username"])) {//no username entered
    header("Location: ../pages/login_page.php?id=1");
} else {
    if (empty($_POST["password"])) {//no password entered
        header("Location: ../pages/login_page.php?id=2");
    } else {
        $user = new User('',$_POST["username"], $_POST["password"],0);
        $user_database = new User_Database('localhost', 'root', '', 'auth');
        if ($user->login($user_database) == 1) {
            $_SESSION['user_id']=strtolower($user->get_username());//Sets the session id to the username if login check is successful
            echo "Login successful! Redirecting!";
            header("Location: ../pages/ToDoList_page.php");//redirects to the main attraction
        } else {
            header("Location: ../pages/login_page.php?id=4");//invalid user or password
        }
    }
}
?>
</body>
</html>
