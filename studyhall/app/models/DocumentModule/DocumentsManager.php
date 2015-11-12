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
        $docList = array();
        $results = get_query("SELECT * FROM `Document`;");
        while($row = $results->fetch_assoc()){
            array_push($docList, $row);
        }
        return $docList;
    }
    
    public function searchDocByClass($class_name){
        $docList = array();
        $query = sprintf("SELECT * FROM Document WHERE class_name='%s';", $class_name);
        $results = get_query($query);
        while($result = $results->fetch_assoc()){
            array_push($docList, $result);
        }
        return $docList;
    }
    
    public function searchDocBySubject($subject){
        $docList = array();
        $query = sprintf("SELECT * FROM Document WHERE subject='%s';", $subject);
        $results = get_query($query);
        while($result = $results->fetch_assoc()){
            array_push($docList, $result);
        }
        return $docList;
    }


}


?>