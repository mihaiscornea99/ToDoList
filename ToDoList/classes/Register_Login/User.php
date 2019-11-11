<?php

namespace Auth;

class User {
    private $email;
    private $username;
    private $password;

    function __construct($email,$username, $password,$send_emails){//constructor
        $this->email=$email;
        $this->username=$username;
        $this->password=$password;
        $this->send_emails=$send_emails;

        //echo 'Constr';
    }


    public function register($database){//this function first checks if an user already is in the database then if they are not, it registers them. Returns 1 if successful.
        $check_duplicate_username=$database->query("SELECT username FROM users WHERE username='$this->username'");
        $check_duplicate_email=$database->query("SELECT email FROM users WHERE email='$this->email'");
        if($check_duplicate_email->num_rows==0){
            if($check_duplicate_username->num_rows==0){
                $hashed_password=password_hash($this->password,PASSWORD_DEFAULT);//storing password in database as hash
                $database->query("INSERT INTO users (email, username, password) VALUES ('$this->email','$this->username','$hashed_password')");

                //mysqli_query($database->get_db(),$register_query);
                return 1;
            }
            else
                return 0;
        }
        else
            return -1;
    }

    public function login($database){//checks if password matches hash from database and returns 1 if successful
        $find_password=$database->query("SELECT password FROM users WHERE username='$this->username'");
        if($find_password->num_rows==0){
            return 0;
        }
        else{
            if(password_verify($this->password,$find_password->fetch_assoc()["password"])){
                return 1;
            }
            else{
                return 0;
            }
        }
    }

    public function get_username(){
        return $this->username;
    }


}
