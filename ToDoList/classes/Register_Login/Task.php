<?php


namespace Auth;


class Task//task class
{
    private $id;
    private $username;
    private $taskname;
    private $deadline;
    private $created_on;
    private $expired;

    function __construct($id,$username, $taskname, $deadline, $created_on){
        $this->id=$id;//This thingy helps us delete them when importing them from sql
        $this->username=$username;
        $this->taskname=$taskname;
        $this->deadline=$deadline;
        $this->created_on=$created_on;
        $current_time=new \DateTime();
        if($deadline<$current_time){//This compares the deadline and the current time to tell us if we missed the deadline
            $this->expired=1;
        }
        else{
            $this->expired=0;
        }
        //echo 'Constr';
    }

    public function get_id(){//just some getters
        return $this->id;
    }
    public function get_deadline(){
        return $this->deadline;
    }
    public function get_deadline_as_string(){//these are a little more special, they return the dates as strings, useful for sql stuff
        $deadline=date_format($this->deadline,'m-d-Y H:i');
        return $deadline;
    }
    public function get_created_on(){
        return $this->created_on;
    }
    public function get_created_on_as_string(){
        $created_on=date_format($this->created_on,'m-d-Y H:i');
        return $created_on;
    }
    public function get_taskname(){
        return $this->taskname;
    }
    public function is_expired(){
        return $this->expired;
    }

    public function test_print(){//function I used for debugging, the PHP equivalent of "cout<<"I got here";"
        echo $this->username."<br>";
        echo $this->taskname."<br>";
        $deadline_string=date_format($this->deadline,'m-d-Y H:i');
        echo $deadline_string."<br>";
        $created_on_string=date_format($this->created_on,'m-d-Y H:i');
        echo $created_on_string."<br>";
        echo $this->expired."<br>";
    }

    public function push_to_db($database){//function that puts a Task object into the tasks table in the database
        $deadline_string=$this->deadline->format('Y-m-d H:i:s');
        $created_on_string=$this->created_on->format('Y-m-d H:i:s');
        $database->query("INSERT INTO tasks (username, taskname, deadline, created_on) VALUES ('$this->username','$this->taskname','$deadline_string','$created_on_string')");
    }

    public static function get_user_tasks($username){//this function takes an username and returns an array of task objects from the tasks table belonging to that username
        $tasks_database=new User_Database('localhost', 'root', '', 'auth');
        $tasks=$tasks_database->query("SELECT id,username,taskname,deadline,created_on FROM tasks WHERE username='$username'");
        $tasks_array = array();
        while($entry=mysqli_fetch_object($tasks)){
            $deadline = new \DateTime($entry->deadline);
            $created_on= new \DateTime($entry->created_on);
            $tasks_array[]=new Task($entry->id,$entry->username,$entry->taskname,$deadline,$created_on);//*oop intensifies*
        }
        return $tasks_array;
    }
    public static function cmp( $a, $b ) {//comparisson function needed to use a sort on my Task class
        if(  $a->deadline ==  $b->deadline ){ return 0 ; }
        return ($a->deadline < $b->deadline) ? -1 : 1;
    }
}