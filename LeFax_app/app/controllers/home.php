<?php
/**
 * @author Armand Nokbak
 */


class Home extends Controller {

    function index() {
        //creating a User model object
        //le premier argument c'est le model, et le deuxieme c'est le module
        //$user = $this->model('User','UserModule');
        //$user->name = $name;
        // creating a view object
        $this->view('home/index');
    }

    //cette fonction te renvoie a la page acceuil apres avoir verifier ton enregistrement
    function indexLogin() {
        session_start();
        if (isset($_POST['username'])) {
            //set $_session variable. important for the index page to acknowledge registered user
            

            //call the login object
            $login = $this->model('login','LoginModule');
            $loginMessage = $login->logMeIn($_POST['username'], $_POST['password']);
            echo $loginMessage;
        }

        $this->view('home/index');
    }

    //helps a guest register
    function indexNewUser() {

        if (isset($_POST['username']) && isset($_POST['password'])) {
            //create a new registered user
            $newUser = $this->model('RegisteredUser', 'UserModule');
            $registration_result = $newUser->register($_POST['firstname'], $_POST['lastname'], $_POST['username'], md5($_POST['password']),
                    $_POST['email'], $_POST['state'], $_POST['city'], 'registered_user', date("Y/m/d"));
            
            //MySQL error handling
            switch ($registration_result){
                case 0:
                    //sending confirmation email
                    $msg = 'Welcome to StudyHall, your favorite study buddy!\n'
                        . '\nPlease click the following link to confirm your registration:\n'
                        . 'http://localhost/lefax_app/public/home/confirmRegistration?'
                        . $_POST['email'].'?'. $_POST['username'];
                    
                    $msg = wordwrap($msg, 70);
                    
                    $headers = "From: an499@mssate.edu";
                    $headers .= "Reply-To: ".$_POST['email'];
                    
                    $email_sent = mail($_POST['email'], 'Welcome to StudyHall', $msg, $headers);
                    
                    //echo 'email_sent = '. $email_sent;
                    
                    echo 'Please check your email for registration confirmation';
                    //set $_session variable. important for the index page to acknowledge registered user
                    $_SESSION['username'] = $_POST['username'];
                    break;
                case 1149:
                    //error message to be displayed
                    $_SESSION['error_message'] = 'Please no apostrophies in the fields';
                    return $this->showRegistration();
                    break;
                case 1064:
                    //error message to be displayed
                    $_SESSION['error_message'] = 'Please no apostrophies in the fields';
                    return $this->showRegistration();
                    break;
                case 1062:
                    $_SESSION['error_message'] = 'sorry, username taken';
                    return $this->showRegistration();
                    break;
                default :
                    $_SESSION['error_message'] = 'error number ' . $registration_result;
                    return $this->showRegistration();
            }
            
            
            
            //delete $newUser for security purposes
            unset($newUser);
            
            //display index page
            $this->index();
        } else {
            
            
            // return to registration page
            $this->showRegistration();
        }
    }

    //sends you to the registration page
    function showRegistration() {

        $this->view('home/registrationView');
    }

    function __construct() {
        
    }

}
