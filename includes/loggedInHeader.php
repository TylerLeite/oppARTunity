<header class="header">
    <a href="index.php"><img src="img/logo.png"></a>

    <article class="navWrap">
        <nav><ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="mission.php">Mission</a></li>
            <li><a href="upload.php">Upload a Picture</a></li>
            <li><a href="<?php echo 'profile.php?user=' . $user->data()->id;?>">Profile</a></li>
            <li><a href="update.php">Update Details</a></li>
            <li><a href="logout.php">Log out</a></li>
        </ul></nav>
    </article>
</header>
