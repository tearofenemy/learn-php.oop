<?php

    function __autoload($class){
        $class = strtolower($class);
        $path = "/includes/{$class}.php";

        if(file_exists($path)){
            require_once($class);
        } else {
            die("Class {$class}.php not found");
        }
    }
    
        
    function redirect($location){
        return header("Location: " . $location);
    }

    function refresh($num){
        return header("Refresh: " . $num);
    }


?>