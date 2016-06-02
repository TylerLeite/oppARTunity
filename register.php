<?php
require_once 'core/init.php';

$user = new user();
if ($user->isLoggedIn()){
    redirect::to('index.php');
}

if (input::exists()){
    if (token::check(input::get('token'))){
        $validate = new validate();
        $validate->check($_POST, array(
            'username' => array(
                'required' => true,
                'min' => 2,
                'max' => 20,
                'unique' => 'users',
                'alpha' => 'true'
            ),
            
            'password' => array(
                'required' => true,
                'min' => 6,
                'max' => 32
            ),
            
            'confirmation' => array(
                'required' => true,
                'matches' => 'password'
            ),
            
            'name' => array(
                'required' => true,
                'min' => 1,
                'max' => 50
            ),
            
            'email' => array(
                'email' => true
            )
        ));
        
        if ($validate->passed()){
            $user = new user();
            $salt = hash::salt(32);
            
            try {
                $user->create(array(
                    'username' => input::get('username'),
                    'password' => hash::make(input::get('password'), $salt),
                    'salt'     => $salt,
                    'name'     => input::get('name'),
                    'joined'   => date('Y-m-d H:i:s'),
                    'group'    => 1,
                    'email'    => input::get('email')
                ));
                
                session::flash('home', 'You have been successfully registered.');
                redirect::to('index.php');
            } catch(Exception $e){
                die($e->getMessage()); //todo: implement an error page
            }
        }
    }   
}
?>

<html lang="en">

<?php include('includes/head.php'); ?>

<body class="body"><div class="wrapper">

<?php
    include('includes/loggedOutHeader.php');
    
    if (input::exists()){
        foreach ($validate->errors() as $error){
          echo '<p class="message">', ucfirst($error), '</p>';
        }
    }
?>
    
    <div class="mainBody">
        <div class="form">
            <form action="" method="post">
                <input type="text" name="username" id="username" value="<?php echo escape(input::get('username')); ?>" autocomplete="off">
                <label for="username">Username</label><br>
                
                <input type="password" name="password" id="password" value="" autocomplete="off">
                <label for="password">Password</label><br>

                <input type="password" name="confirmation" id="confirmation" value="" autocomplete="off">
                <label for="confirmation">Confirm Password</label><br>

                <input type="text" name="name" id="name" value="<?php echo escape(input::get('name')); ?>" autocomplete="off">
                <label for="name">Full Name</label><br>
                
                <input type="text" name="email" id="email" value="<?php echo escape(input::get('email')); ?>" autocomplete="off">
                <label for="name">email Address (Not required)</label><br>
                
                <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                <article class="center"><input type="submit" class="submit" value="Register"></article>
            </form>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</div></body>

</html>
