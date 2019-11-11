<?php
//This class is here mostly to take up extra disk space and to host these comments regarding how the database should look like

//database will be called "auth"
//"users" table has 5 columns: id (INT, auto increment),email(varchar,latin1_general_cs, length:40),username (varchar,latin1_general_ci,length:16),password (varchar,latin1_general_cs, length:255),send_emails(INT)
//tasks database has 5 columns: id(INT, auto increment), username(varchar,latin1_general_ci,length:16), taskname(varchar,latin1_general_cs,length:100), deadline(datetime), created_on(datetime)

namespace Auth; // Auth/User

//public static $link='localhost';
//public static $user='naf_silvahawk';
//public static $password='!_B?i@TtjX?I';
//public static $database_name='naf_auth';

class User_Database {
    public static $link='localhost';
    public static $user='root';
    public static $password='';
    public static $database_name='naf_auth';
    private $db;

    function __construct($link,$user,$password,$database_name){
        $this->db=mysqli_connect(User_Database::$link,User_Database::$user,User_Database::$password,User_Database::$database_name);
        //echo 'Constr';
    }
    
        public function get_db(){
        return $this->db;
    }

    public function link($link,$user,$password,$table){
        $this->db=mysqli_connect($link,$user,$password,$table);
    }

    public function query($query){
        return $this->db->query($query);
    }
}