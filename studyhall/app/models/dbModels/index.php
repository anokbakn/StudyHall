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
        
        
        ////////////////////////////////
        //RegisteredUser UNIT TESTS
        ////////////////////////////////
        printf("/////////////////////////////////\n");
        printf("STARTING RegisteredUser UNIT TESTS\n");
        printf("/////////////////////////////////\n");
        $user = new RegisteredUser();
        
        //register new user
        $user->register("armand", "abc123", "anokbak@something.com", "Armand", "Nokbak", "MS", "Starkville");
        unset($user);
        
        //get existing user
        $user = new RegisteredUser('armand');  
        
        //get existing user data
        $email = $user->getEmail();
        printf("Armand's email is %s\n", $email);
        
        //get existing user
        $user2 = new RegisteredUser("armand5");
        
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
        $loginSuccess2 = $user2->login("armand", "abc12"); 
        if(is_null($loginSuccess2)){
            $pass_fail = "fail";
        }
        else {
            $pass_fail = $loginSuccess2;
        }
        printf("User %s logged in successfully: %s\n", "armand", $pass_fail);
        
        
        //delete user
        $user->deleteUser();
        
        
        //block user
        $user2->block();
        $isBlocked = $user2->isBlocked();
        $bool_str = $isBlocked ? "true" : "false";
        printf("User is blocked: %s\n", $bool_str);
        
        //unblock user
        $user2->unblock();
        $isBlocked2 = $user2->isBlocked();
        $bool_str2 = $isBlocked2 ? "true" : "false";
        printf("User is blocked: %s\n", $bool_str2);

        
        unset($user);
        unset($user2);
        
        
        ////////////////////////////
        //Subject UNIT TESTS
        ////////////////////////////
        printf("/////////////////////////////////\n");
        printf("STARTING Subject UNIT TESTS\n");
        printf("/////////////////////////////////\n");
        
        //construct subject
        $subject = new Subject();
        
        //add subject
        $subject->addSubject("Math");
        
        //get subject
        $subject_string = $subject->getSubject();
        printf("Got Subject: %s\n", $subject_string);
        
        //get AZSubjectArray
        $orderedArray = $subject->getAZSubjects();
        printf("Ordered Subjects: \n");
        foreach($orderedArray as $subject_val){
            printf("%s\n", $subject_val);
        }
        

        ////////////////////////////
        //Classes UNIT TESTS
        ////////////////////////////
        printf("/////////////////////////////////\n");
        printf("STARTING Classes UNIT TESTS\n");
        printf("/////////////////////////////////\n");
        
        //construct empty class
        $class = new Classes();
        
        //add a class
        $class->addClass("Calculus I", "Math");
        
        unset($class);
        
        //get class from db
        $class2 = new Classes("Calculus I");
        
        //get subject for class
        $my_subject = $class2->getSubject();
        printf("Calculus I subject is: %s\n", $my_subject);
        
        $orderedArray = $class2->getAZClassList();
        printf("Ordered Classes: \n");
        foreach($orderedArray as $class_val){
            printf("%s\n", $class_val);
        }
        
        //add class
        
        ////////////////////////////
        //Document UNIT TESTS
        ////////////////////////////
        
        
        ?>
    </body>
</html>
