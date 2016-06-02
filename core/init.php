<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => 'localhost',
        'username' => 'oppARTunity',
        'password' => 'ljskc2rfjaftm8ax',
        'db' => 'oppartunity'
    ),
    
    'remember' => array(
        'cookie_name' => 'choco_chip',
        'cookie_expiry' => 604800
    ),
    
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);

spl_autoload_register(function($class){
    require_once 'classes/' . $class . '.php';
});

require_once 'functions/sanitize.php';

if (cookie::exists(config::get('remember/cookie_name')) && !session::exists(config::get('session/session_name'))) {
    $hash = cookie::get(config::get('remember/cookie_name'));
    $hash_check = db::getInstance()->get('users_session', array('hash', '=', $hash));
    
    if ($hash_check->count()){
        $user = new user($hash_check->firstResult()->user_id);
        $user->login();
    }
}

?>
