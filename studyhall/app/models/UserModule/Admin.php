<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include_once "./db_functions.php";
include_once "./RegisteredUser.php";
include_once "./ForumTopic.php";
include_once "./Document.php";
/**
 * Description of Admin
 *
 * @author Kristen
 */
class Admin {
    //put your code here
    
    function __construct(){
        return;
    }
    
    public function deleteUser($RegisteredUser){
        $RegisteredUser->deleteUser();
        //return if success/fail
    }
    public function blockUser($RegisteredUser){
        $RegisteredUser->block();
        //return if success/fail
    }
    public function unblockUser($RegisteredUser){
        $RegisteredUser->unblock();
        //return if success/fail
    }
    public function deleteForumTopic($Forum){
        $Forum->deleteForumTopic();
        //return if success/fail
    }
    public function blockForumTopic($Forum){
        $Forum->block();
        //return if success/fail
    }
    public function unblockForumTopic($Forum){
        $Forum->unblock();
        //return if success/fail
    }
    public function deleteDocument($Document){
        $Document->deleteDocument();
        //return if success/fail
    }
    public function blockDocument($Document){
        $Document->block();
        //return if success/fail
    }
    public function unblockDocument($Document){
        $Document->unblock();
        //return if success/fail
    }
}
