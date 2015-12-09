<?php


include_once "db_functions.php";
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
            db_add("Registered_User", sprintf("'%s','%s','%s', '%s', '%s', false, null, '%s', '%s', NULL", $username, $password, $email, $first_name, $last_name, $state, $city));
        }
        
        //setting blocked date to NULL
        /**
        $db_conn = db_conn();
        $query_string = "UPDATE Registered_User SET blocked_date=NULL where username='".$username."'";
        $results = mysqli_query($db_conn, $query_string);
                
        mysqli_close($db_conn);
        **/
        
    }
     /**
     *@author Armand Nokbak
     **/
     public function getUserRole($username){
     	
	$db_conn = db_conn();
        $query_string = "SELECT * from Registered_User where username='".$username."'";
        $results = mysqli_query($db_conn, $query_string);
        //$result = $result->fetch_assoc();
        $role = "";
        while($result = $results->fetch_assoc()) {
        	if(($result['admin']==1)){ //if admin
        		 $role = "admin";
        	}
        	else{
        		 $role = "registered_user";
        	}
        	
        }        
        
        mysqli_close($db_conn);
        //var_export($docList);
        
       
        return  $role;
     
     }
    
    public function deleteUser($username){
        db_delete("Registered_User", "username", $username);
    }
    
    //password input should already be in MD5 form
    //returns role if login success, null if login failed
    public function login($username, $password){
    	session_start();
        if(value_exists("Registered_User", "username", $username)){
            $db_val = db_get("Registered_User", "password", "username", $username);
            
            //making sure user is not blocked
            $db_conn = db_conn();
	        $query_string = "SELECT * from Registered_User where username='".$username."'";
	        $results = mysqli_query($db_conn, $query_string);
	        $isBlocked = true;
	        
	        while($result = $results->fetch_assoc()) {
	        	if(($result['blocked_date']==NULL)){ //if not blocked
	        		 $isBlocked = false;
	        	}
	        	else{
	        		 $isBlocked = true;
	        		 $_SESSION['errorMessage'] = 'This user is blocked!';
	        		  return null; // do not let the user login
	        		 
	        	}
	        	
	        }        
	        
	        mysqli_close($db_conn);
	            
      
            if(strcmp($password, $db_val['password']) == 0){
            	echo $this->admin;
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
    
    public function block($username){
        db_set("Registered_User", "blocked_date=NOW()", "username", $username);
        date_default_timezone_set("America/Chicago");
        $this->blocked_date = date('m/d/Y G:i:s');
    }
    
    public function unblock($username){
        db_set("Registered_User", "blocked_date=NULL", "username", $username);
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

?>