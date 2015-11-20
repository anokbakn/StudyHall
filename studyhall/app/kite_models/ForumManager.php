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
    
    public function getPostsByTopic($topic_id){
        $postList = array();
        $query = sprintf("SELECT * FROM Forum_Post WHERE topic_id=%d;", $topic_id);
        $results = get_query($query);
        return $results;
    }
}
