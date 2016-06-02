<?php
require_once 'core/init.php';
require_once 'functions/classify.php';
require_once 'functions/randomPic.php';
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
    <div class="mainBody">        
        <article class="content">
		    <p>
                  When one thinks about social networking today, there is certainly a feeling of individuality. Each person has his own page or her own blog, which is highly personal. Sometimes, people will form groups, but still, for an outside viewer, there is a feeling of individuality. One may only look at the individuals within the group, but not at the group as a whole. The goal of oppARTunity is to create a collaborative social networking platform that is not focused on any one individual, but instead, is focused on the bigger picture of how many different individuals interact together.
            </p>
            <p>
                 I liken this process of constructing a collaborative social network to that of building a city. Each city is itself a work of art, but its brilliance is hardly derived from a single person or building or restaurant. Rather, a city is special because of the unique amalgam of all of its individual components. Moreover, cities are notable for being dynamic ecosystems, which rely on change. This continuous change is most noticeably seen in the moving around of all of the individual elements to form a new city. And so oppARTunity tries to create unique jumbles of individual contributions to form a work of art that is beyond the capacity of one single person.
			</p>
			<p>
				The idea of oppARTunity is to create pictures with more pictures—like a collage. If you click on one picture in a collage, immediately a new collage will be formed that tries to create the picture that you clicked on. Inevitably, there will be some (or many) imperfections, but that is part of the art.
			</p>
        </article>
        
        <article class="missionFooter">
           <p>Rohit Chandran<br>Founder and CEO</p>
        </article>
    </div>
    
    <?php include('includes/footer.php'); ?>
</div></body>

</html>
