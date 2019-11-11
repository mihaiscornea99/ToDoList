<?php
namespace Auth;
include ("../classes/Register_Login/User.php");
include ("../classes/Register_Login/User_Database.php");
include ("../classes/Register_Login/Task.php");
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../pages/login_page.php");
} ?>
<?php// echo $_SESSION['user_id']; ?>
<html>
<head>
    <title>TO-DO list</title>
    <link rel="stylesheet" type="text/css" href="styles/ToDoListStyle.css">
</head>
<body>
<div class="logout_button_container">
    <?php
    $database=new User_Database('localhost', 'root', '', 'auth');
    $sendmails=$database->query("SELECT send_mails FROM users WHERE username='".$_SESSION['user_id']."'");
    if($sendmails->fetch_assoc()['send_mails']==0){
        echo "<a href='../Actions/email_setting.php' class='logout_button'>Notify me by email!</a>";
    }
    else{
        echo "<a href='../Actions/email_setting.php' class='logout_button'>Stop emailing me!</a>";
    }


    ?><a href="../pages/change_email_page.php" class="logout_button">Change email address</a><a href="../pages/change_password_page.php" class="logout_button">Change password</a><a href="../Actions/logout.php" class="logout_button">Log Out</a>
</div>
<br>
<div class="site-title">
    Welcome, <?php echo $_SESSION['user_id'];?>!
</div>
<br>
<?php
if(isset($_GET['editid'])){
    $task_database=new User_Database('localhost', 'root', '', 'auth');
    $edit_id=$_GET['editid'];
    $task_from_db=$task_database->query("SELECT id,username,taskname,deadline,created_on FROM tasks WHERE id='$edit_id'");
    $task_to_edit=$task_from_db->fetch_assoc();

    if($_SESSION['user_id']==$task_to_edit['username']){
        echo "<p><a href=\"../pages/ToDoList_page.php\" class=\"back_to_create_button\">Back to creating a new task</a></p>
    <form method=\"post\" action=\"../Actions/edit_task.php?editid=$edit_id\">
    <p>Editing task \"".$task_to_edit['taskname']."\"</p>
    <div class=\"input-group\">
        <label>Rename task:</label>
        <input type=\"text\" name=\"taskname\" value=\"".$task_to_edit['taskname']."\">
    </div>
    <div class=\"input-group\">
        <label>Choose another deadline. If you don't choose, it stays unchanged.</label>
        <input type=\"datetime-local\" name=\"taskdeadline\">
    </div>
    <div class=\"input-group\">
        <button type=\"submit\" class=\"btn\" name=\"reg_user\">Save changes!</button>
    </div>
</form><br><br>";
    }
    else{
        header('Location: ../pages/ToDoList_page.php');
    }
}
else{
    echo "<br><br>
    <form method=\"post\" action=\"../Actions/create_task.php\">
    <p>Create a new task here!</p>
    <div class=\"input-group\">
        <label>Task name:</label>
        <input type=\"text\" name=\"taskname\">
    </div>
    <div class=\"input-group\">
        <label>Task deadline:</label>
        <input type=\"datetime-local\" name=\"taskdeadline\">
    </div>
    <div class=\"input-group\">
        <button type=\"submit\" class=\"btn\" name=\"reg_user\">Create task!</button>
    </div>
</form>
<br>
<br>";
}
?>

<?php
if(isset($_GET['id'])){//yet another mighty switch of error messages
    switch ($_GET['id']){
        case 1:
            echo '<div class="failure">Please input a task name!</div>';
            break;
        case 2:
            echo '<div class="failure">Task name can\'t exceed 100 characters!</div>';
            break;
        case 3:
            echo '<div class="failure">Please input a task deadline!</div>';
            break;
        case 4:
            echo '<div class="success">Task added successfully!</div>';
            break;
        case 5:
            echo '<div class="success">Task deleted successfully!</div>';
            break;
        case 6:
            echo '<div class="success">Task edited successfully!</div>';
            break;
        case 7:
            echo '<div class="success">Password changed successfully!</div>';
            break;
        case 8:
            echo '<div class="success">Email address changed successfully!</div>';
            break;
    }
}

?>

<table class="tasks-table">
    <tr class="tasktabletitle"><td>Your current TO-DO list:</td></tr>
    <tr class="tasktableheader"><td>Task name</td><td>Deadline</td><td>Created at</td><td>Status</td><td>Edit</td><td>Delete</td></tr>
    <?php

    $tasks_array=Task::get_user_tasks($_SESSION['user_id']);//this generates a table row for each task, along with a custom delete button just for that one
    $task_template=new Task(0,"test","test","test","test");
    usort($tasks_array,array($task_template,'cmp'));

    foreach ($tasks_array as $task){
        echo'<tr class="taskrow"><td class="taskname">'.$task->get_taskname().'</td><td>'.$task->get_deadline_as_string().'</td><td>'.$task->get_created_on_as_string().'</td>';
        if($task->is_expired()){
            echo '<td class="expired">Failed</td>';
        }
        else{
            echo '<td class="ongoing">Ongoing</td>';
        }
        $taskid=$task->get_id();
        echo "<td class='edit-button-cell'><a href='../pages/ToDoList_page.php?editid=".$taskid."' class='edit_button'>Edit</a></td>";
        echo "<td class='delete-button-cell'><a href='../Actions/delete_task.php?id=".$taskid."' class='delete_button'>Delete</a></td>";
        echo'</tr>';
    }
    ?>
</table>
<br>
    <div>
        <a href="../pages/delete_account_page.php" class="delete_button">Delet laif</a>
    </div>
<br>
Warning: This button deletes your account.
</body>
</html>
