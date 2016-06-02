<?php

function randomPic($color = 'random'){
    if ($color == 'random'){
        $colors = array(
            'black',
            'blue',
            'brown',
            'gray',
            'green',
            'orange',
            'pink',
            'purple',
            'red',
            'white',
            'yellow'
        );
        
        $color = $colors[array_rand($colors)];
    }
    
    $files = glob('uploads/' . $color . '/*.*');
    $file = array_rand($files);
    return $files[$file];
}

?>
