<?php
require_once 'core/init.php';

$user = new user();
$user->logout();

//session::flash('home', 'You have been logged out successfully.');
redirect::to('index.php');

?>
