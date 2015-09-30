<?php
/**
 * @author Armand Nokbak
 */


class RegisteredUser {

    private $firstName;
    private $lastName;
    private $userName;
    private $password;
    private $email;
    private $state;
    private $city;
    private $role;
    private $signUpDate;
    

    function __construct() {
        
    }

    function register($firstName, $lastName, $userName, $password, $email, $state, $city, $role, $signUpDate) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->password = $password;
        $this->email = $email;
        $this->state = $state;
        $this->city = $city;
        $this->role = $role;
        $this->signUpDate = $signUpDate;
        

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
        
        $sql = "INSERT INTO registered_users (first_name, last_name, email, user_name, password, state, city,
            role, sign_up)
                VALUES ('$this->firstName', '$this->lastName', '$this->email', '$this->userName', '$this->password', '$this->state', '$this->city', '$this->role', '$this->signUpDate')";

        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->errno;
            //return error number for error handling
            return $conn->errno;
        }
        
        //disconnects db
        $conn->close();
        //echo 'Connection closed';
    }

    
    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getUserName() {
        return $this->userName;
    }

    function getPassword() {
        return $this->password;
    }

    function getEmail() {
        return $this->email;
    }

    function getState() {
        return $this->state;
    }

    function getCity() {
        return $this->city;
    }

    function getRole() {
        return $this->role;
    }

    function getSignUpDate() {
        return $this->signUpDate;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setUserName($userName) {
        $this->userName = $userName;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setState($state) {
        $this->state = $state;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setRole($role) {
        $this->role = $role;
    }

    function setSignUpDate($signUpDate) {
        $this->signUpDate = $signUpDate;
    }

}
