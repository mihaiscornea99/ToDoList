<?php
namespace Auth;
include ("../classes/Register_Login/User.php");
include ("../classes/Register_Login/User_Database.php");
include ("../classes/Register_Login/Task.php");

//cron job: 0 0 * * * curl http://naf.ro/Actions/send_emails.php?password=bananas

$password=$_GET['password'];
$okpassword='bananas';

if (!($password==$okpassword)) {
    die('lul,hacker!');
}

//if (  !($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['REMOTE_ADDR'] == '127.0.0.1') )

//if(!isempty($_SERVER['HTTP_HOST'])){
//    header("HTTP/1.1 404 Not Found");
//    exit();
//}
$database=new User_Database('localhost', 'root', '', 'auth');
$soon_tasks=$database->query("SELECT taskname,username,deadline FROM tasks WHERE deadline<CURRENT_DATE()+INTERVAL 2 DAY AND deadline>CURRENT_DATE()");

while($soon_task=$soon_tasks->fetch_assoc()){
    $email_address=$database->query("SELECT email,send_mails FROM users WHERE username='".$soon_task['username']."'")->fetch_assoc();
    if($email_address['send_mails']==1){
        mail($email_address['email'],"A task is going to expire soon!","Greetings, ".$soon_task['username']."!\n Your task \n\"".$soon_task['taskname']."\" \nis going to expire on\n".$soon_task['deadline']."\nThank you for using our site!\nIf you are tired of these emails, come log in and disable them!\nhttp://naf.ro/pages/login_page.php");
    }
}
