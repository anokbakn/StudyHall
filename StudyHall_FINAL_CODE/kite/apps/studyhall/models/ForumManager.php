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
include_once "db_functions.php";
 

class ForumManager {
    //put your code here
    
    public function showTopics(){
        $topicList = array();
        $db_conn = db_conn();
        $query_string = "SELECT * FROM Forum_Topic";
        $results = mysqli_query($db_conn, $query_string);
        
        while($result = $results->fetch_assoc()) {
        	//if(($result['blocked']==NULL) || ($result['blocked']==0)){ //if not blocked
        		array_push($topicList, $result);
        		//echo $doc['doc_id'].'<br>';
        	//}
        	//else{
        		// do nothing
        	//}
        	
        }        
        
        mysqli_close($db_conn);
        
        return $topicList;
    }
    
    public function getPostsByTopic($topic_id){
        $postList = array();
        $db_conn = db_conn();
        $query_string = "SELECT * FROM Forum_Post WHERE topic_id=". $topic_id;
        
        $results = mysqli_query($db_conn, $query_string);
        
        while($result = $results->fetch_assoc()) {
        	if(($result['blocked']==NULL) || ($result['blocked']==0)){ //if not blocked
        		array_push($postList, $result);
        		//echo $doc['doc_id'].'<br>';
        	}
        	else{
        		// do nothing
        	}
        	
        }        
        
        mysqli_close($db_conn);
        
        return $postList;
    }
}