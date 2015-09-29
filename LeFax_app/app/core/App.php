<?php

class App {

    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];
    
    function __construct() {
        $url = $this->parseUrl();
        
        
        if(file_exists('../app/controllers/'. $url[0] .'.php')){ //checks if the controller exists
            $this->controller = $url[0];
            unset($url[0]); //nullifies it from the array
        }
        
        require_once '../app/controllers/'.$this->controller.'.php'; // so if asked for a controller that is 
        //not there if will default to the home controller
        
        $this->controller = new $this->controller; // replaces this instance of controller by a new instance
        //of controller (apparently so as to keep defaulting to the home controller)
        
        if(isset($url[1])){//if a method is passed in the url
            if(method_exists($this->controller, $url[1])){ //if the method exists in the controller
                $this->method = $url[1]; //sets the method to the requested method
                unset($url[1]); //nullifies the method from the passed url
            }
        }
        
        $this->params = $url ? array_values($url) : []; //does $url still valid? if yes then reindex it
        //else set $url to empty array and assign it to $this->params
        
        call_user_func_array([$this->controller, $this->method],[]);//, $this->params); //calls the method from the 
        //controller, passing in the parameters
        
    }
    
    function parseUrl(){
        if(isset($_GET['url'])){
            return $url = explode('/',filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}