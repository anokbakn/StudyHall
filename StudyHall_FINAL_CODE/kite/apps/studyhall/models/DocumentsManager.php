<?php
/**
*	@author Armand Nokbak
**/

        // put your code here
include_once "db_functions.php";

class DocumentsManager{

private $documentsList;

/**
* This method shows unblocked docs
**/
function showDocuments(){
	$documentsList=NULL;
	$db_conn = db_conn();
        $query_string = "SELECT * from Document";
        $results = mysqli_query($db_conn, $query_string);
        //$result = $result->fetch_assoc();
        $docList = array();
        while($result = $results->fetch_assoc()) {
        	if(($result['blocked']==NULL) || ($result['blocked']==0)){ //if not blocked
        		array_push($docList, $result);
        		//echo $doc['doc_id'].'<br>';
        	}
        	else{
        		// do nothing
        	}
        	
        }        
        
        mysqli_close($db_conn);
        //var_export($docList);
        return $docList;

}

/**
* This method shows unblocked and blocked docs
**/
function showAllDocuments(){
	$documentsList=NULL;
	$db_conn = db_conn();
        $query_string = "SELECT * from Document";
        $results = mysqli_query($db_conn, $query_string);
        //$result = $result->fetch_assoc();
        $docList = array();
        while($result = $results->fetch_assoc()) {
        	
        		array_push($docList, $result);
        		//echo $doc['doc_id'].'<br>';
        	
        	
        }        
        
        mysqli_close($db_conn);
        //var_export($docList);
        return $docList;

}

public function searchDocByClass($class_name){
        $query = sprintf("SELECT * FROM Document WHERE class_name='%s';", $class_name);
        $results = get_query($query);
	$docList = array();
	if(is_null($results)){
		$docList = array();
	}
	else {
		while($result = $results->fetch_assoc()){
			array_push($docList, $result);
        	}
	}
        return $docList;
    }


}


?>