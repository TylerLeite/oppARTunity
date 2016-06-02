<?php
//logo font is "aeonis pro light"

require_once 'core/init.php';
require_once 'functions/classify.php';
require_once 'functions/randomPic.php';
require_once 'functions/mapColorToCSS.php';

$page = input::get('page');
if ($page != ''){
    if (in_array($page, array('login', 'index', 'mission', 'register', 'upload', 'profile', 'logout', 'update'))){
        redirect::to(escape($page . '.php'));
    } else {
        redirect::to(404);
    }
}

$path = 'uploads/preload/splash.png';
if (input::get('color') != '' && input::get('name') != ''){
    $path = 'uploads/' . input::get('color') . '/' . input::get('name') . '.png';
}

if (!file_exists($path)){
    redirect::to(404);
}

if (input::get('random') != ''){
    $path = randomPic();
    $pathParts = explode('/', $path);
    $color = $pathParts[1];
    $tmpArr = explode('.', $pathParts[2]);
    array_pop($tmpArr);
    $name = implode('.', $tmpArr);
    redirect::to('index.php?color=' . $color . '&name=' . $name);
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
?>

        <p class="message">
            Please <a href="login.php">Log In</a> or <a href="register.php">Register</a> to upload pictures.
        </p>

<?php
    }
?>

    <div class="mainBody">
        <!-- The two wrappers are necessary for centering a div of unknown width -->
        <article class="mosaicWrapper">
        <article class="mosaicWrapper2">
        <article class="mosaic">            
            <?php
                if (input::get('color') != '' && input::get('name') != ''){
                    $db = db::getInstance();
                    $uploadData = $db->get('uploads', array('name', '=', $path))->firstResult();
                    $showCreds = false;
                    echo '<p class="paragraph">' . (($uploadData->title != '') ? $uploadData->title : str_replace('.png', '', explode('/', $uploadData->name)[2])) . '</p>';
                } else if (!input::exists()){
                    echo '<p class="paragraph">Below is a randomly generated collage of user-uploaded pictures.<br>Click on one of the tiles to see a collage of that picture.</p>';
                    $showCreds = true;
                }
                
                $image = imagecreatefrompng($path);
                $wdt = imagesx($image);
                $hgt = imagesy($image);
                
                $out = '<div class="mosaicPictures">';
                for ($y = 0; $y < $hgt; $y++){
                    for ($x = 0; $x < $wdt; $x++){
                        $rgb = imagecolorat($image, $x, $y);
                        $r = ($rgb >> 16) & 0xFF;
                        $g = ($rgb >> 8) & 0xFF;
                        $b = $rgb & 0xFF;
                        
                        $s = 0;
                        $pixelColor = classify($r, $g, $b, $s);
                        $files = glob('uploads/' . $pixelColor . '/*.*');
                        $file = $files[array_rand($files)];
                        
                        $parts = explode('/', $file);
                        $color = $parts[1];
                        $nameParts = explode('.', $parts[2]);
                        $name = $nameParts[0];
                        
                        if ($s > 0){
                            $shade = 'light';
                        } else if ($s < 0){
                            $shade = 'dark';
                        } else {
                            $shade = 'normal';
                        }
                        
                        $bgColor = mapColorToCSS($shade, $color);
                        
                        $anchor = '<a style="background:' . $bgColor . ';" href="index.php?color=' . $color . '&name=' . $name . '">';
                        $img    = '<img class="tile" src="' . $file . '">';
                        
                        $out .= $anchor . $img . '</a></a>';
                        //$out .= '<a style="background:' . $color . ';opacity:0.8;" href="index.php?color=' . $color . '&name=' . $name . '"><img class="' . $shade . ' "width="3" height="3" src="' . $file . '"></a>';
                    }
                    
                    $out .= '<br>';
                }
                
                $out .= '</div><p class="paragraph"><a href="index.php?random=true">Random</a> | <a href="' . $path . '" target="_blank">Original</a></p><br>';
                
                echo $out .  "\n";
            ?>
            
        </article>
        </article>
        </article>
    </div>
    
    <?php include('includes/footer.php'); ?>
</div>

<?php
    if ($showCreds){
?>
        <article class="credits">
        <p>
            Concept and design by Rohit Chandran<br>
            Programming by Tyler Leite
        </p>
        </article>
<?php
    }
?>

</body>

</html>

<?php
/*
<article class="credits">
    <p>
<?php
        if ($showCreds){
?>
            Concept and design by Rohit Chandran<br>
            Programming by Tyler Leite
<?php
        } else {
?>
            Original picture by <?php echo $db->get('users', array('username', '=', $uploadData->uploader))->firstResult()->name . ' (' . $uploadData->uploader; ?>)</a>
<?php
        }
?>
    </p>
</article>

//*/
?>
