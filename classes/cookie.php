<?php

class cookie {
    public static function exists($name){
        return isset($_COOKIE[$name]);
    }
    
    public static function get($name){
        return $_COOKIE[$name];
    }
    
    public static function put($name, $value, $expiry){
        return setcookie($name, $value, time() + $expiry, '/');
    }
    
    public static function delete($name){
        self::put($name, '', time() - 1);
    }
}

?>
