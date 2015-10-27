
<?php
        // put your code here
require './db_functions.php';

class Document{
    //variable declaration
    private $doc_id;
    private $username;
    private $class_name;
    private $subject;
    private $doc_name;
    private $doc_type;
    private $path_to_doc;
    private $upvotes;
    private $downvotes;
    private $blocked;
    
    private $new_doc;
    
    //constructor
    function __construct($doc_id = 0){
        //check if doc_id is 0
        if($doc_id == 0){ 
            $this->new_doc = true;
            return;
        }
        //get doc values from database and set
        else {
            $this->new_doc = false;
            //conn to database
            $db_vals = db_functions.db_get("Document", "*", "doc_id", sprintf("'%d'", $doc_id));
            $this->username = $db_vals['username'];
            $this->class_name = $db_vals['class_name'];
            $this->subject = $db_vals['subject'];
            $this->doc_name = $db_vals['doc_name'];
            $this->doc_type = $db_vals['doc_type'];
            $this->path_to_doc = $db_vals['path_to_doc'];
            $this->upvotes = $db_vals['upvotes'];
            $this->downvotes = $db_vals['downvotes'];
            $this->blocked = $db_vals['blocked'];
            return;
        }
    }
    
    function __autoload($class_name){
        include $class_name . '.php';
    }
    
    public function createDocument($username, 
                        $class_name,
                        $subject,
                        $doc_name,
                        $doc_type,
                        $path_to_doc){
        //get random doc_id
        $doc_id = db_functions.get_rand_num();
        while(db_functions.value_exists("Document", "doc_id", $doc_id)){
            $doc_id = db_functions.get_rand_num();
        }
        db_add("Document", sprintf("'%d', '%s', '%s', '%s', '%s', '%s', '%s', '0', '0', 'false'", $doc_id, $username, $class_name, $subject, $doc_name, $doc_type, $path_to_doc));
        //check for error, return value to user based on if error or not
    }
    
    public function deleteDocument(){
        //check for error, return value to user based on if error or not
        db_delete("Document", "doc_id", $this->doc_id);
        return;
    }
    
    public function rate($updown){
        //downvotes
        if($updown == 0){
            $new_val = $this->downvotes + 1;
            db_functions.db_set("Document", sprintf("downvotes='%d'", $new_val), "doc_id", $this->doc_id);
            $this->downvotes = $new_val;    
        }
        //upvotes
        if($updown == 1){
            $new_val = $this->upvotes + 1;
            db_functions.db_set("Document", sprintf("upvotes='%d'", $new_val), "doc_id", $this->doc_id);
            $this->upvotes = $new_val;
        }
    }
    
    public function block(){
        db_set("Document", "blocked='true'", "doc_id", $this->doc_id);
        $this->blocked = true;
    }
    
    public function isBlocked(){
        $db_val = db_get("Document", "blocked", "doc_id", $this->doc_id);
        $blocked_bool = $db_val["blocked"];
        return $blocked_bool;
    }
    
    public function getDocID(){
        return $this->doc_id;
    }
    
    public function getUsername(){
        return $this->username;
    }
    public function getClassName(){
        return $this->class_name;
    }
    public function getSubject(){
        return $this->subject;
    }
    public function getDocName(){
        return $this->doc_name;
    }
    public function getDocType(){
        return $this->doc_type;
    }
    public function getPathToDoc(){
        return $this->path_to_doc;
    }
    public function getUpvotes(){
        return $this->upvotes;
    }
    public function getDownvotes(){
        return $this->downvotes;
    }
}
?>

