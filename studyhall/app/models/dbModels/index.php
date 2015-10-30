<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        foreach(glob("./*.php") as $filename){
            include_once $filename;
        }
        
        //RegisteredUser "unit tests"
        
        //get existing users
        $user = new RegisteredUser('armand');  
        
        //get existing user data
        $email = $user->getEmail();
        printf("Armand's email is %s\n", $email);
        
        //create new user
        $user2 = new RegisteredUser();
        
        //register new user
        $user2->register('armand5', 'abc123', 'km1035@msstate.edu', 'Kristen', 'Massey', 'MS', 'Jackson');
        
        //login successful (print true)
        $loginSuccess = $user2->login("armand", "abc123");
        if(is_null($loginSuccess)){
            $pass_fail = "fail";
        }
        else {
            $pass_fail = $loginSuccess;
        }
        printf("User %s logged in successfully: %s\n", "armand", $pass_fail);
        
        //login unsuccessful (print false)
        $loginSuccess = $user2->login("armand", "abc12"); 
        if(is_null($loginSuccess)){
            $pass_fail = "fail";
        }
        else {
            $pass_fail = $loginSuccess;
        }
        printf("User %s logged in successfully: %s\n", "armand", $pass_fail);
        
        /*
        //delete user
        $user->deleteUser();
        
        //block user
        $user2->block();
        $isBlocked = $user->isBlocked();
        printf("User is blocked: %s", $isBlocked);
        
        //unblock user
        $user2->unblock();
        $isBlocked = $user->isBlocked();
        printf("User is blocked: %s", $isBlocked);
         * 
         */
        
        
        unset($user);
        unset($user2);
        ?>
    </body>
</html>
