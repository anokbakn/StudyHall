<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumManager
 *
 * @author Kristen
 */
class ForumManager {
    //put your code here
    
    public function showTopics(){
        $topicList = array();
        $results = get_query("SELECT * FROM `Forum_Topic`;");
        return $results;
    }
    
    /*
    public function searchTopicByClass($class_name){
        $topicList = array();
        $query = sprintf("SELECT * FROM Forum_Topic WHERE class_name='%s';", $class_name);
        $results = get_query($query);
        while($result = $results->fetch_assoc()){
            array_push($topicList, $result);
        }
        return $topicList;
    }
    
    
    public function searchTopicBySubject($subject){
        $topicList = array();
        $query = sprintf("SELECT * FROM Forum_Topic WHERE subject='%s';", $subject);
        $results = get_query($query);
        while($result = $results->fetch_assoc()){
            array_push($topicList, $result);
        }
        return $topicList;
    }
    */
}
