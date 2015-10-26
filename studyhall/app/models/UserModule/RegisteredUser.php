<?php


require '../dbModels/db_functions.php';
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
            $db_vals = db_functions.db_get("Registered_User", "*", "username", sprintf("'%s'", $username));
            $this->password = $db_vals['password'];
            $this->email = $db_vals['email'];
            $this->first_name = $db_vals['first_name'];
            $this->last_name = $db_vals['last_name'];
            $this->admin = $db_vals['admin'];
            $this->blocked_date = $db_vals['blocked_date'];
            $this->state = $db_vals['state'];
            $this->city = $db_vals['city'];
            $this->sign_up = $db_vals['sign_up'];
            return;
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
        if(db_functions.value_exists("Registered_User", "username", $username)){
            return false;
        }
        else{
            db_add("Registered_User", sprintf("'%s','%s','%s', '%s', '%s', false, null, '%s', '%s', NOW()"));
        }
        
    }
    
    //password input should already be in MD5 form
    //returns true if login success, false if login failed
    public function login($username, $password){
        if(db_functions.value_exists("Registered_User", "username", $username)){
            $db_val = db_functions.db_get("Registered_User", "password", "username", $username);
      
            if($password == $db_val['password']){
                return true;    
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    
    public function block(){
        db_functions.db_set("Registered_User", "blocked_date=NOW()", "username", $this->username);
    }
    
    public function unblock(){
        db_functions.db_set("Registered_User", "blocked_date=NULL", "username", $this->username);
    }
    
    public function isBlocked(){
        $db_val = db_get("Registered_User", "blocked_date", "username", $this->username);
        $sql_blocked_date = $db_val['blocked_date'];
        //if val is null, they are unblocked
        if($sql_blocked_date == NULL){
            return false;
        }
        //if val is over 24 hours ago, they are unblocked
        $php_blocked_date = strtotime($sql_blocked_date);
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
        
        
    
}
