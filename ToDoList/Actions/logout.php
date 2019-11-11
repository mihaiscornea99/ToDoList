<?php
namespace Auth;
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../pages/login_page.php");
}
?>

<?php
include ("../classes/Register_Login/User.php");
session_destroy();//this entire file is dedicated to this line of code
header("Location: ../pages/login_page.php");
?>