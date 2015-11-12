<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comment
 *
 * @author Kristen
 */
class Comment {
    //put your code here
    private $comment_id;
    private $doc_id;
    private $username;
    private $comment_body;
    private $blocked;
    
    private $new_comment;
    
    function __construct($comment_id = 0){
        //check if comment_id is 0
        if($comment_id == 0){ 
            $this->new_comment = true;
            return;
        }
        //get doc values from database and set
        else {
            $this->new_comment = false;
            //conn to database
            $db_vals = db_functions.db_get("Comment", "*", "comment_id", sprintf("'%d'", $comment_id));
            $this->comment_id = $comment_id;
            $this->comment_body = $db_vals['comment_body'];
            $this->doc_id = $db_vals['doc_id'];
            $this->username = $db_vals['username'];
            $this->blocked = $db_vals['blocked'];
            return;
        }  
    }
    
    function __autoload($class_name){
        include $class_name . '.php';
    }
    
    public function createComment($comment_body, 
                                    $doc_id,
                                    $username,
                                    $comment_body){
        $comment_id = db_functions.get_rand_num();
        while(db_functions.value_exists("Comment", "comment_id", $comment_id)){
            $comment_id = get_rand_num();
        }
        
        db_add("Comment", sprintf("'%d', '%d', '%s', '%s', 'false'", $comment_id, $doc_id, $username, $comment_body));
        
        $this->comment_id = $comment_id;
        $this->doc_id = $doc_id;
        $this->username = $username;
        $this->comment_body = $comment_body;
        $this->blocked = false;
        
    }
    
    public function deleteComment(){
        //check for error, return value to user based on if error or not
        db_delete("Comment", "comment_id", $this->comment_id);
        return;
    }
    
    public function block(){
        db_set("Comment", "blocked='true'", "comment_id", $this->comment_id);
        $this->blocked = true;
    }
    
    public function unblock(){
        db_set("Comment", "blocked=false", "comment_id", $this->comment_id);
        $this->blocked = false;
    }
    
    public function isBlocked(){
        $db_val = db_get("Comment", "blocked", "comment_id", $this->comment_id);
        $blocked_bool = $db_val["blocked"];
        return $blocked_bool;
    }
    
    public function getCommentID(){
        return $this->comment_id;
    }
    public function getCommentBody(){
        return $this->comment_body;
    }
    public function getDocID(){
        return $this->doc_id;
    }
    public function getUsername(){
        return $this->username;
    }
}
