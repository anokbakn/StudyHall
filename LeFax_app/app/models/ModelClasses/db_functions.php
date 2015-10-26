<?php

/* 
 * Functions for reuse in interacting with database - connecting + getting and setting data
 */


class db_functions{
    function db_get($table, $items, $primary_key, $key_value){
        $db_conn = db_conn();
        $get_data = sprintf("SELECT %s FROM %s WHERE %s='%s';", $items, $table, $primary_key, $key_value);
        $data = $db_conn->query($get_data);
        $values = $data->fetch_assoc();
        return $values;
    }
    
    function db_set($table, $items, $primary_key, $key_value){
        $db_conn = db_conn();
        $set_data = sprintf("UPDATE %s SET %s WHERE %s='%s';", $table, $items, $primary_key, $key_value);
        $data = $db_conn->query($set_data);
        $values = $data->fetch_assoc();
        return $values;
    }
    
    function db_add($table, $items){
        $db_conn = db_conn();
        $add_data = sprintf("INSERT INTO %s VALUES (%s);", $table, $items);
        $data = $db_conn->query($add_data);
        $values = $data->fetch_assoc();
        return $values;
    }
    
    function db_delete($table, $primary_key, $key_value){
        $db_conn = db_conn();
        $del_data = sprintf("DELETE FROM %s WHERE %s='%s';", $table, $primary_key, $key_value);
        $db_conn->query($del_data);
    }
    
    function value_exists($table, $key, $value){
        $db_conn = db_conn();
        $query_string = sprintf("SELECT * from %s WHERE %s='%s';", $table, $key, $value);
        $query = mysqli_query($db_conn, $query_string);
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
        $passd = "studyhall123";
        
        //create connection to database
        $db_conn = new mysqli($host, $user, $passwd, $database);
        
        //if db_conn failed then kill connection
        if ($db_conn->connect_error){
            die("Connection attempt failed: " . $db_conn->connect_error);
        }
        else {
            return $db_conn;   
        } 
    }
}
?>