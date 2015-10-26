<?php
/**
 * cette classe nous permet de verifier les utilisateurs
 * elle appellera la classe PasswordHash aussi.
 */
class Login {

    private $username;
    private $password;
    
    function __construct() {
        $this->username = '';
        $this->password = '';
        
    }
    //login function
    function logMeIn($entered_username, $enteredPassword){
        //connects to db
        //code extracted from  http://www.w3schools.com/php/php_mysql_connect.asp on 9/28/2015
        $servername = "localhost";
        $username = "root";
        $dbPassword = "root";

        // Create connection
        $conn = new mysqli($servername, $username, $dbPassword);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //echo "Connected successfully";

        //ADD NEW REGISTERED USER
        $sql1 = "USE studyhall_users";
        if ($conn->query($sql1) === TRUE) {
            //echo "db selected";
        } else {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
            //return error number for error handling
            return $conn->errno;
        }
        $encrypt_pass = md5($enteredPassword);
        
        $sql = "SELECT first_name, last_name, role FROM registered_users WHERE user_name = '$entered_username' AND password = '$encrypt_pass'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['first_name'] = $row["first_name"];
                $_SESSION['last_name'] = $row["last_name"];
                $_SESSION['role'] = $row["role"];
                $_SESSION['username'] = $entered_username;
                return 'Welcome ' . $_SESSION['first_name'];
            }
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->errno;
            //return error number for error handling
            return 'Please check username or password';
        }

        //disconnects db
        $conn->close();
        //echo 'Connection closed';
    }
    
    //pour inserer le nom d'utilisateur
    function setUserName($username){
        $this->username = $username;
    }
    //pour retourner le nomm d'utilisateur
    function getUserName(){
        return $this->username;
    }
    //pour inserer le password
    function setPassword($pass){
        $this->password = $pass;
    }
    //pas de getPassword parce que nous voulons limiter les transactions de password
    

}

?>