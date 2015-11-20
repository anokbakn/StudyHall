<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumPost
 *
 * @author Kristen
 */
class ForumPost {
    //put your code here
    private $post_id;
    private $topic_id;
    private $username;
    private $post_content;
    private $blocked;
    private $new_forum_post;
    
    //constructor
    function __construct($post_id = NULL){
        if($post_id == NULL){ 
            $this->new_forum_post = true;
        }
        //get doc values from database and set
        else {
            $this->new_forum_post = false;
            //conn to database
            $db_vals = db_get("Forum_Post", "*", "post_id", sprintf("%d", $post_id));
            $this->post_id = $post_id;
            $this->topic_id = $db_vals['topic_id'];
            $this->username = $db_vals['username'];
            $this->post_content = $db_vals['post_content'];
            $this->blocked = $db_vals['blocked'];
        }  
        
    }
    
    function __destruct(){
        
    }
    
    function createPost($topic_id,
                        $username, 
                        $post_content){
        //get random doc_id
        $post_id = get_rand_num();
        while(value_exists("Forum_Post", "post_id", $post_id)){
            $post_id = get_rand_num();
        }
        
        db_add("Forum_Post", sprintf("'%d', '%d', '%s', '%s', 'false'", $post_id, $topic_id, $username, $post_content));
        $this->post_id = $post_id;
        $this->topic_id = $topic_id;
        $this->username = $username;
        $this->post_content = $post_content;
        $this->blocked = false;
    }
    
    function deletePost(){
        //check for error, return value to user based on if error or not
        db_delete("Forum_Post", "post_id", $this->post_id);
        return;
    }
    
     public function block(){
        db_set("Forum_Post", "blocked=true", "post_id", $this->post_id);
        $this->blocked = true;
    }
    
    public function unblock(){
        db_set("Forum_Post", "blocked=false", "post_id", $this->post_id);
        $this->blocked = false;
    }
    
    public function isBlocked(){
        $db_val = db_get("Forum_Post", "blocked", "post_id", $this->post_id);
        $blocked_bool = $db_val["blocked"];
        return $blocked_bool;
    }
    
    function getPostID(){
        return $this->post_id;
    }
    
    function getTopicID(){
        return $this->topic_id;
    }
    
    function getUsername(){
        return $this->username;
    }
    
    function getPostContent(){
        return $this->post_content;
    }
}