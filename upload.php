<?php
require_once 'core/init.php';
require_once 'functions/resize.php';

$user = new user();
if (!$user->isLoggedIn()){
    redirect::to('index.php');
}
?>
<html lang="en">

<?php include('includes/head.php'); ?>

<body class="body"><div class="wrapper">

<?php

include('includes/loggedInHeader.php');

if (input::exists()){
    $dir = 'uploads/' . input::get('color') . '/';
    $name = $_FILES['file']['name'];
    $parts = explode('.', $name);
    $ext = end($parts);
    $name = $parts[0] . '.' . $ext;
    $actualName = $parts[0];
    $originalName = $actualName;
    
    $i = 1;
    while(file_exists($dir . $actualName . '.png')){       
        $actualName = $originalName . $i;
        $name = $actualName . '.' . $ext;
        $i++;
    }

    $newFName = $dir.basename($name);
    
    $validate = new validate();
    $validate->check($_POST, array(
        'color' => array(
            'not' => 'null'
        ),
        
        'title' =>array(
            'required' => 'true',
            'max' => 64,
        )
    ));
    
    $validate->check($_FILES, array(    
        'file' => array(
            'maxFileSize' => 5242880,
            'allowedExts' => array('gif', 'jpeg', 'jpg', 'png')
       )
    ));
    
    if ($validate->passed()){
        move_uploaded_file($_FILES['file']['tmp_name'], $newFName);
        $newName = resize($newFName);
        
        $user = new user();
        
        $db = db::getInstance();
        $db->insert('uploads', array(
            'name' => $newName,
            'uploader' => $user->data()->username,
            'title' => escape(input::get('title'))
        ));
        
        echo '<p class="message">Image uploaded successfully! See the collage <a href="index.php?color=' . input::get('color') . '&name=' . $actualName . '">here.</a></p><br>';
    } else {
        foreach ($validate->errors() as $error){
            echo '<p class="message">', ucfirst($error), '</p>';
        }
    }
}
?>

    <div class="mainBody">
        <article class="info">
            <p>Maximum upload size is five megabytes. Supported file types are: jpeg, gif, and png</p>
        </article>

        <div class="form">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="file" class="file">
                <label for="file"> Upload a picture</label> <br>   
            
                <input type="text" name="title" />
                <label for="title"> Please title your picture </label><br>
                
                <select name="color" class="color">
                    <option value="null">Select a Color</option>
                    <option value="black">Black</option>
                    <option value="blue">Blue</option>
                    <option value="brown">Brown</option>
                    <option value="gray">Gray</option>
                    <option value="green">Green</option>
                    <option value="orange">Orange</option>
                    <option value="pink">Pink</option>
                    <option value="purple">Purple</option>
                    <option value="red">Red</option>
                    <option value="white">White</option>
                    <option value="yellow">Yellow</option>
                </select>
                <label for="color">If you were asked to describe your picture as a single color, that color would be...</label><br>
                
                <br>
                <article class="info">
                    By clicking the "Upload" button below, you certify that you own the rights to any above file(s) that you 
                    have selected to upload. In addition, by clicking the "Upload" button below, you certify that the contents 
                    of the file(s) that you have selected to upload are appropriate and suitable for other users of the website.
                </article>
                <article class="center"><input type="submit" name="submit" class="submit" value="Upload"></article>
            </form>
        </div>
    </div>
        
    <?php include('includes/footer.php'); ?>
</div></body>

</html>
