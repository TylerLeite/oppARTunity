<?php

class input {
    public static function exists($type = 'post'){
        switch($type){
            case 'post':
                return !empty($_POST);
                break;
            case 'get':
                return !empty($_GET);
            default:
                return false;
        }
    }
    
    public static function get($item){
        if (isset($_POST[$item])){
            return escape($_POST[$item]);
        } else if (isset($_GET[$item])){
            return escape($_GET[$item]);
        }

        return '';
    }
}

?>
