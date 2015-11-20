<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumTopic
 *
 * @author Kristen
 */
class ForumTopic {
    private $topic_id;
    private $username;
    private $topic_name;
    private $topic_description;
    private $blocked;
    private $new_forum_topic;
    
    //constructor
    function __construct($topic_id = NULL){
        if($topic_id == NULL){ 
            $this->new_forum_topic = true;
        }
        //get doc values from database and set
        else {
            $this->new_forum_topic = false;
            //conn to database
            $db_vals = db_get("Forum_Topic", "*", "topic_id", sprintf("%d", $topic_id));
            $this->topic_id = $topic_id;
            $this->username = $db_vals['username'];
            $this->topic_name = $db_vals['topic_name'];
            $this->topic_description = $db_vals['topic_description'];
            $this->blocked = $db_vals['blocked'];
        }  
        
    }
    
    function __destruct(){
        
    }
    
    function createForum($username, 
                        $topic_name, 
                        $topic_description){
        //get random doc_id
        $topic_id = get_rand_num();
        while(value_exists("Forum_Topic", "topic_id", $topic_id)){
            $topic_id = get_rand_num();
        }
        
        db_add("Forum_Topic", sprintf("'%d', '%s', '%s', '%s', 'false'", $topic_id, $username, $topic_name, $topic_description));
        $this->topic_id = $topic_id;
        $this->username = $username;
        $this->topic_name = $topic_name;
        $this->topic_description = $topic_description;
        $this->blocked = false;
    }
    
    function deleteForum(){
        //check for error, return value to user based on if error or not
        db_delete("Forum_Topic", "topic_id", $this->topic_id);
        return;
    }
    
     public function block(){
        db_set("Forum_Topic", "blocked=true", "topic_id", $this->topic_id);
        $this->blocked = true;
    }
    
    public function unblock(){
        db_set("Forum_Topic", "blocked=false", "topic_id", $this->topic_id);
        $this->blocked = false;
    }
    
    public function isBlocked(){
        $db_val = db_get("Forum_Topic", "blocked", "topic_id", $this->topic_id);
        $blocked_bool = $db_val["blocked"];
        return $blocked_bool;
    }
    
    function getTopicID(){
        return $this->topic_id;
    }
    
    function getUsername(){
        return $this->username;
    }
    
    function getTopicName(){
        return $this->topic_name;
    }
    
    function getTopicDescription(){
        return $this->topic_description;
    }
}
