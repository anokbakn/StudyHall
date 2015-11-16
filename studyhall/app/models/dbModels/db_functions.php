<?php

/* 
 * Functions for reuse in interacting with database - connecting + getting and setting data
 */

/*
 * 
 */
    function db_get($table, $items, $primary_key, $key_value){
        $db_conn = db_conn();
        if(strcmp($items, "*") == 0){
            $get_data = sprintf("SELECT * FROM `%s` WHERE %s='%s';", $table, $primary_key, mysql_real_escape_string($key_value));//, $primary_key, $key_value);  
        }
        else{
          $get_data = sprintf("SELECT %s FROM `%s` WHERE %s='%s';", $items, $table, $primary_key, mysql_real_escape_string($key_value));      
        }
        
        $data = $db_conn->query($get_data);
        if($data->num_rows > 0){
            $values = $data->fetch_assoc();
            mysqli_close($db_conn);
            return $values;
        }
        else{
            mysqli_close($db_conn);
            return false;
        }
    }
    
    function db_set($table, $items, $primary_key, $key_value){
        $db_conn = db_conn();
        $set_data = sprintf("UPDATE %s SET %s WHERE %s='%s';", $table, $items, $primary_key, mysql_real_escape_string($key_value));
        $data = $db_conn->query($set_data);
        mysqli_close($db_conn);
    }
    
    function db_add($table, $items){
        $db_conn = db_conn();
        $add_data = sprintf("INSERT INTO %s VALUES (%s);", $table, $items);
        $data = $db_conn->query($add_data);
        mysqli_close($db_conn);
    }
    
    function db_delete($table, $primary_key, $key_value){
        $db_conn = db_conn();
        $del_data = sprintf("DELETE FROM %s WHERE %s='%s';", $table, $primary_key, mysql_real_escape_string($key_value));
        $db_conn->query($del_data);
        mysqli_close($db_conn);
    }
    
    function db_get_ordered($table, $items, $order_column, $primary_key, $key_value){
        $db_conn = db_conn();
        $get_data = sprintf("SELECT %s FROM %s WHERE %s='%s' ORDER BY %s;", $items, $table, $primary_key, $key_value, $order_column);
        $data = $db_conn->query($get_data);
        mysqli_close($db_conn);
        return $data;   //can return numberous values
    }
    
    function get_query($query){
        $db_conn = db_conn();
        $rowArray = array();
        $data = $db_conn->query($query);
        mysqli_close($db_conn);
        if(mysqli_num_rows($data) > 0){
            return $data;
        }
        else {
            return null;
        }
    }
    
    function value_exists($table, $key, $value){
        $db_conn = db_conn();
        $query_string = sprintf("SELECT * from %s WHERE %s='%s';", $table, $key, mysql_real_escape_string($value));
        $query = mysqli_query($db_conn, $query_string);
        mysqli_close($db_conn);
        if(mysqli_num_rows($query) > 0){
            return true;
        }
        else{
            return false;
        }
    }
    
    function get_rand_num(){
        $int = rand(1, 2147483647);
        return $int;
    }
    
    function db_conn(){
        $host = "pluto.cse.msstate.edu";
        $user = "dcsp01";
        $database = "dcsp01";
        $passwd = "studyhall123";
        
        //create connection to database
        $db_conn = new mysqli($host, $user, $passwd, $database);
        
        //if db_conn failed then kill connection
        if ($db_conn->connect_error){
            die("Connection attempt failed: " . $db_conn->connect_error);
        }
        else {
            mysql_select_db("dcsp01");
            return $db_conn;   
        } 
    }
?>