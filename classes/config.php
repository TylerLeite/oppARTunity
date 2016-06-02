<?php

class config {
    public static function get($path = null){
        if ($path){
            $config = $GLOBALS['config'];
            $path = explode('/', $path);
            
            foreach ($path as $part){
                if (isset($config[$part])){
                    $config = $config[$part];
                } else {
                    return false;
                }
            }
            
            return $config;
        } else {
            return false;
        }
    }
}

?>
