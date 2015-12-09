<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include_once "db_functions.php";
include_once "RegisteredUser.php";
include_once "ForumTopic.php";
include_once "Document.php";
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
    
    /** @author Armand Nokbak
    	This function gets all the users for the Admin **/
    public function getAllUsers(){
    	$usersList=NULL;
	$db_conn = db_conn();
        $query_string = "SELECT * from Registered_User";
        $results = mysqli_query($db_conn, $query_string);
        //$result = $result->fetch_assoc();
        $usersList = array();
        while($result = $results->fetch_assoc()) {
        	
        		array_push($usersList, $result);
        		//echo $doc['doc_id'].'<br>';
        	
        	
        }        
        
        mysqli_close($db_conn);
        //var_export($docList);
        return $usersList;
    
    }
    
    public function deleteUser($username){
        deleteUser($username);
        //return if success/fail
    }
    public function blockUser($username){
        block($username);
        //return if success/fail
    }
    public function unblockUser($username){
        unblock($username);
        //return if success/fail
    }
    public function deleteForum($Forum){
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