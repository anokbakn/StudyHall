<?php


include_once "./db_functions.php";
/**
 * Description of RegisteredUser
 *
 * @author Kristen
 */
class RegisteredUser {
    //put your code here
    private $username;
    private $password;
    private $email;
    private $first_name;
    private $last_name;
    private $admin;
    private $blocked_date;
    private $state;
    private $sign_up;
    
    private $new_user;
    
    //constructor
    function __construct($username = NULL){
        //check if doc_id is 0
        if($username == NULL){ 
            $this->new_user = true;
            return;
        }
        //get doc values from database and set
        else {
            $this->new_user = false;
            //conn to database
            $db_vals = db_get("Registered_User", "*", "username", sprintf("%s", $username));
            if(isset($db_vals)){
                $this->username = $username;
                $this->password = $db_vals['password'];
                $this->email = $db_vals['email'];
                $this->first_name = $db_vals['first_name'];
                $this->last_name = $db_vals['last_name'];
                $this->admin = $db_vals['admin'];
                $this->blocked_date = $db_vals['blocked_date'];
                $this->state = $db_vals['state'];
                $this->city = $db_vals['city'];
                $this->sign_up = $db_vals['sign_up'];
                return true;
            }
            else{
                return false;
            }
        }
    }
    //password should already be MD5, username should already be checked
    public function register($username,
                            $password,
                            $email,
                            $first_name,
                            $last_name,
                            $state,
                            $city){
        if(value_exists("Registered_User", "username", $username)){
            return false;
        }
        else{
            db_add("Registered_User", sprintf("'%s','%s','%s', '%s', '%s', false, null, '%s', '%s', NOW()", $username, $password, $email, $first_name, $last_name, $state, $city));
        }
        
    }
    
    public function deleteUser(){
        db_delete("Registered_User", "username", $this->username);
    }
    
    //password input should already be in MD5 form
    //returns role if login success, null if login failed
    public function login($username, $password){
        if(value_exists("Registered_User", "username", $username)){
            $db_val = db_get("Registered_User", "password", "username", $username);
      
            if(strcmp($password, $db_val['password']) == 0){
                $role = ($this->admin) ? "admin" : "registered_user";
                return $role;    
            }
            else{
                return null;
            }
        }
        else{
            return null;
        }
    }
    
    public function block(){
        db_set("Registered_User", "blocked_date=NOW()", "username", $this->username);
        date_default_timezone_set("America/Chicago");
        $this->blocked_date = date('m/d/Y G:i:s');
    }
    
    public function unblock(){
        db_set("Registered_User", "blocked_date=NULL", "username", $this->username);
        $this->blocked_date = null;
    }
    
    public function isBlocked(){
        $blocked_date = $this->blocked_date;
        //if val is null, they are unblocked
        if(is_null($blocked_date)){
            return false;
        }
        $php_blocked_date = strtotime($blocked_date);
        //if val is over 24 hours ago, they are unblocked
        if(time() - $php_blocked_date > (60*60*24)){
            return false;    
        }
        //else they are blocked
        else{
            return true;
        }
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function getFirstName(){
        return $this->first_name;
    }
    
    public function getLastName(){
        return $this->last_name;
    }
    
    public function isAdmin(){
        return $this->admin;
    }
    
    public function getBlockedDate(){
        return $this->blocked_date;
    }
    
    public function getState(){
        return $this->state;
    }
    
    public function getCity(){
        return $this->city;
    }
    
    public function getSignUpDate(){
        return $this->sign_up;
    }
    
    public function toString(){
        $objectString = sprintf("RegisteredUser(username=%s, password=%s, email=%s, first_name=%s, last_name=%s, admin=%d, blocked_date=%s, state=%s, city=%s, sign_up=%s\n", $this->username, $this->password, $this->email, $this->first_name, $this->last_name, $this->admin, $this->blocked_date, $this->state, $this->city, $this->sign_up);
        return $objectString;
        
    }
        
        
    
}
