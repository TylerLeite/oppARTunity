<?php
require_once 'core/init.php';

if (!$id = input::get('id')){
    redirect::to('index.php');
} else {
    $user = new user($id);
    
    if (!$user->exists()){
        redirect::to(404);
    } else {
        $data = $user->data();
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
?>

    <div class="article">
        <div class="title">
            <p><?php echo escape($data->username); ?></p>
        </div>
        
        <article class="uploads">
            <p><h3>Uploads:</h3></p>
    
<?php
            $db = db::getInstance();
			$user->find(escape(input::get('user')));
            $uploads = $db->get('uploads', array('uploader', '=', $user->data()->username));
			
			$pics = array_reverse($uploads->results());
			
            foreach ($pics as $info){
                $file = explode('/', $info->name);
                $nameParts = explode('.', $file[2]);
                $name = $nameParts[0];
				$title = $db->get('uploads', array('name', '=', $info->name))->firstResult()->title;
				if ($title == ''){
					$title = $name;
				}
                echo '<a href="index.php?color=' . $file[1] . '&name=' . $name . '">' . $title . '</a><br>';
            }
}
?>
            <br>
        </article>
    </div>
    
    <?php include('includes/footer.php'); ?>
</div></body>

</html>
