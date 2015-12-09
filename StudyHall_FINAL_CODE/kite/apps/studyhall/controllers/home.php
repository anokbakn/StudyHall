<?php
/**
 * @author Armand Nokbak
 */


class Home extends Kite {
	
	/** use $_SESSION['errorMessage'] to pass error messages **/

    function main() {
        
        // creating a view object
        $this->render('index');
    }
    
    function index() {
        
        // creating a view object
        $this->render('index');
    }

    function contact(){
        // creating a view object
        $this->render('contact');
    }
    
    //redirects to the registration page
    function showRegistration(){
    	if(!isset($_SESSION['username'])){
    		$this->render('registrationForm');
    		}
    	else{
    		$this->render('index');
    	}
    }
    
    //redirects to the login page
    function showLoginPage(){
    	if(!isset($_SESSION['username'])){
    		$this->render('registrationForm');
    		}
    	else{
    		$this->render('index');
    	}
    
    }
    
    //to log a user out
    function logout(){
    	//connect to ongoing session
    	session_start();
    	// remove all session variables
	session_unset(); 

	// destroy the session 
	session_destroy(); 
	
	//redirect to index
	$this->render('index');
    }
    
    //to register new users
    function registerNewUser(){
    	if(isset( $_POST['username']))
    	{
    		//create a RegisteredUser object
    		$registrationModel = $this->getmodel('RegisteredUser');
    		$registrationModel->register($_POST['username'], md5($_POST['password']), $_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['state'], $_POST['city']);
    		
    		session_start();
    		$_SESSION['username'] = $_POST['username'];
    		//$_SESSION['role'] = 0;
    		
    		$_SESSION['registrationErrorMessage']='Welcome to StudyHall. You are now a registered user!';
    		
    		$this->render('index');
    	}
    	else{
    		$this->render('registrationForm');
    	}
    }
    
    /** this method logs in a registered user **/
    function indexLogMeIn(){
    	session_start(); // connects to ongoing session
    	
    	if(isset( $_POST['username'])){ /**if user filled out the form**/
    		//create a RegisteredUser object
    		$registrationModel = $this->getmodel('RegisteredUser');
    		$loginResult = $registrationModel->login($_POST['username'], md5($_POST['password']));
    		
    		if($loginResult==="admin" || $loginResult==="registered_user"){	/** if login was successful**/
    			$_SESSION['username'] = $_POST['username'];
    			$_SESSION['role'] = $registrationModel->getUserRole($_POST['username']);/**setting the user's role **/
    			
    			$this->render('index'); //redirects to index
    		}
    		else{	/** if login was not successful **/
    			if(isset($_SESSION['errorMessage'])&& ($_SESSION['errorMessage'] == 'This user is blocked!')){
    			
    			}
    			else{
    				$_SESSION['errorMessage'] = 'wrong username or password';
    			}
    			
    			$this->render('registrationForm'); //redirects to login form
    		}
    		
    	}
    	else{
    		$this->render('registrationForm'); /** make them login **/
    	}
    }
    
    
    function adminConsole(){
    	// check admin permissions
    	session_start(); //connect to the ongoing session
		
	$documentsManager = $this->getmodel('DocumentsManager');
		//echo '<p>'.$documentsManager->showDocuments()[0][0].'</p>';
	$documentsList = $documentsManager->showAllDocuments();
	$_SESSION['documentsList'] = $documentsList;
	
	$usersManager = $this->getmodel('Admin');
	$usersList = $usersManager->getAllUsers();
	$_SESSION['usersList'] = $usersList;
	
	
    	$this->render('adminConsole');
    }
    
    function blockUser(){
    	// check admin permissions
    	session_start(); //connect to the ongoing session
		
	if(isset($_POST['username'])){
		$this->getmodel('RegisteredUser')->block($_POST['username']);
		$this->adminConsole();
	}
	else{
		$this->main();
	}
    
    }
    
    function unblockUser(){
    	// check admin permissions
    	session_start(); //connect to the ongoing session
		
	if(isset($_POST['username'])){
		$this->getmodel('RegisteredUser')->unblock($_POST['username']);
		$this->adminConsole();
	}
	else{
		$this->main();
	}
    
    }
    
    function deleteUser(){
    	// check admin permissions
    	session_start(); //connect to the ongoing session
		
	if(isset($_POST['username'])){
		$this->getmodel('RegisteredUser')->deleteUser($_POST['username']);
		$this->adminConsole();
	}
	else{
		$this->main();
	}
    
    }

    
    
    
}