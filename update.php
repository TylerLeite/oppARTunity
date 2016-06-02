<?php
require_once 'core/init.php';

$user = new user();
if (!$user->isLoggedIn()){
    redirect::to("index.php");
}

if (input::exists()){
    if (token::check(input::get('token'))){
        $validate = new validate();
        $validate->check($_POST, array(
            'name' => array(
                'required' => true,
                'min' => 1,
                'max' => 50
            ),
            
            'password' => array(
                'required' => true
            ),
            
            'email' => array(
                'email' => true;
            ),
            
            'newPassword' => array(
                'min' => 6,
                'max' => 32
            ),
            
            'newPasswordConfirm' => array(
                'matches' => 'newPassword'
            ),
        ));
        
        if ($validate->passed()){
            try {
                $salt = hash::salt(32);
                
                if ($user->data()->password === hash::make(input::get('password'), $user->data()->salt)){
                    $user->update(array(
                        'password' => hash::make(input::get('newPassword'), $salt),
                        'salt' => $salt,
                        'name' => input::get('name'),
                        'email' => input::fet('email')
                    ));
                } else {
                    echo 'Invalid password', '<br>';
                }

                session::flash('home', 'Your details have successfully been updated.');
                redirect::to('index.php');
            } catch(Exception $e){
                die($e->getMessage());
            }
        }
    } 
}
?>

<html lang="en">

<?php include('includes/head.php'); ?>

<body class="body"><div class="wrapper">
<?php
    $user = new user();
    if ($user->isLoggedIn()){
        include('includes/loggedInHeader.php');
    } else {
        include('includes/loggedOutHeader.php');
    }
    
    if (input::exists()){
        foreach ($validate->errors() as $error){
            echo '<p class="message">', ucfirst($error), '</p>';
        }
    }
?>

    <br>
    <div class="mainBody">
		<div class="form">
			<form action="" method="post">
				<input type="text" name="name" value="<?php echo escape($user->data()->name); ?>">
				<label for="name">Name</label><br>

				<input type="password" name="newPassword" id="newPassword" value="" autocomplete="off">
				<label for="newPassword">New Password</label><br>

				<input type="password" name="newPasswordConfirm" id="newPasswordConfirm" value="" autocomplete="off">
				<label for="newPasswordConfirm">Confirm New Password</label><br>

				<input type="password" name="password" id="password" value="" autocomplete="off">
				<label for="password">Current Password (Required)</label><br>

				<input type="hidden" name="token" value="<?php echo token::generate(); ?>"><br>
					
				<article class="center"><input type="submit" value="Update" class="submit"></article>
			</form>
		</div>
	</div>
    
    <?php include('includes/footer.php'); ?>
</div></body>

</html>
