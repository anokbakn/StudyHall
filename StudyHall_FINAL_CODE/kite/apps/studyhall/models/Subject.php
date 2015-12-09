<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Subject
 *
 * @author Kristen
 */

include_once "db_functions.php";


class Subject {
    //put your code here
    private $subject;
    
    function __construct($subject = NULL){
        $this->subject = $subject;    
    }
    public function addSubject($subject){
        db_add("Subject", sprintf("'%s'", $subject));
        $this->subject = $subject;
    }
    public function getAZSubjects(){
        $data = db_get_ordered("Subject", "*", "subject", "1", 1);
        $AZSubjectArray = array();
        while($row = $data->fetch_assoc()){
            array_push($AZSubjectArray, $row['subject']);
        }
        return $AZSubjectArray;  
    }
    public function getSubject(){
        return $this->subject;
    }
}
