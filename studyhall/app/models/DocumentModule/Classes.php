<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once "./db_functions.php";
/**
 * Description of Classes
 *
 * @author Kristen
 */
class Classes {
    //put your code here
    private $class_name;
    private $subject;
    
    private $new_class;
    
    //constructor
    function __construct($class_name = NULL){
        if($class_name == NULL){ 
            $this->new_class = true;
        }
        //get doc values from database and set
        else {
            $this->new_class = false;
            //conn to database
            $db_vals = db_get("Classes", "*", "class_name", sprintf("%s", $class_name));
            $this->class_name = $class_name;
            $this->subject = $db_vals['subject'];
        }  
        
    }
    
    public function addClass($class_name, $subject){
        if(value_exists("Classes", "class_name", $class_name)){
            return false;
        }
        else{
            db_add("Classes", sprintf("'%s', '%s'", $class_name, $subject));
            $this->class_name = $class_name;
            $this->subject = $subject;
            return true;
        }
    }
    
    public function getAZClassList(){
        $data = db_get_ordered("Classes", "*", "class_name");
        $AZClassArray = array();
        while($row = $data->fetch_assoc()){
            array_push($AZClassArray, $row['class_name']);
        } 
        return $AZClassArray;
    }
    
    public function getClassName(){
        return $this->class_name;
    }
    public function getSubject(){
        return $this->subject;
    }
}
