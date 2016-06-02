<?php
require_once 'core/init.php';

$user = new user();
if ($user->isLoggedIn()){
    redirect::to('index.php');
}

if (input::exists()){
    if (token::check(input::get('token'))){
        $validate = new validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));
        
        if ($validate->passed()){
            $user = new user();
            
            $remember = input::get('remember') === 'on';
            $login = $user->login(input::get('username'), input::get('password'), $remember);
            
            if ($login){
                session::flash('home', '<p class="message">You have been successfully logged in.</p>');
                redirect::to('index.php');
            }
        }
    }
}
?>

<html lang="en">

<?php include('includes/head.php'); ?>

<body class="body"><div class="wrapper">

<?php include('includes/loggedOutHeader.php'); 

if (input::exists()){
    echo '<p class="message">The username or password was incorrect.<p>';
   
    foreach ($validate->errors() as $error){
        echo '<p class="message">', ucfirst($error), '</p>';
    }
}
?>

    <div class="mainBody">
        <div class="form">
            <form action="" method="post">
                <input type="text" name="username" autocomplete="off">
                <label for="username">Username</label><br>
                
                <input type="password" name="password">
                <label for="password">Password</label><br>
                
                <label for="remember">
                    Remember Me <input type="checkbox" name="remember" id="remember">
                </label><br>
                
                <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                <article class="center"><input type="submit" class="submit" value="Log in"></article>
            </form>
        </div>
    </div>
    
    <?php include('includes/footer.php'); ?>
</div></body>

</html>
