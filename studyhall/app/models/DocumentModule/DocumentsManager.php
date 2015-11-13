<?php
/**
*	@author Armand Nokbak, Kristen Massey
**/

include_once "./db_functions.php";

class DocumentsManager{
    
    function __construct(){
        return;
    }

    public function showDocuments(){
        $results = get_query("SELECT * FROM `Document`;");
        return $results;
    }
    
    public function searchDocByClass($class_name){
        $query = sprintf("SELECT * FROM Document WHERE class_name='%s';", $class_name);
        $results = get_query($query);
        return $results;
    }
    
    public function searchDocBySubject($subject){
        $query = sprintf("SELECT * FROM Document WHERE subject='%s';", $subject);
        $results = get_query($query);
        return $results;
    }
    
    public function searchCommentByDoc($doc_id){
        $query = sprintf("SELECT * FROM Comment WHERE doc_id='%s';", $doc_id);
        $results = get_query($query);
        return $results;
    }


}


?>