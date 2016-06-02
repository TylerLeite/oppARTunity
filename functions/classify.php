<?php

function classify($r, $g, $b, &$sh=0){
    // for $sh (shade), 0 = normal, 50 = bright, -50 = dark

    $r /= 255;
    $g /= 255;
    $b /= 255;
 
    $max = max($r, $g, $b);
    $min = min($r, $g, $b);
 
    $h;
    $s;
    $v = ($max + $min) / 2;
    $d = $max - $min;
 
    if ($d == 0){  // achromatic
        $h = 0;
        $s = 0;
    } else {
        $s = $d / (1 - abs(2*$v - 1));

        switch ($max){
            case $r:
                $h = 60 * fmod((($g - $b) / $d), 6); 
                if ($b > $g){
                    $h += 360;
                }
                break;
            case $g: 
                $h = 60 * (($b - $r) / $d + 2); 
                break;
            case $b: 
                $h = 60 * (($r - $g) / $d + 4); 
                break;
        }                                
    }
    
    $h = round($h, 2);
    $s = round($s, 2);
    $v = round($v, 2);
    
    if ($v >= 0.8){
        $sh = 50;
    } else if ($v <= 0.4){
        $sh = -50;
    } else {
        $sh = 0;
    }
    
    if ($v <= 0.15){
        $sh = -50;
        return 'black';
    } else if ($s <= 0.15 && $v >= 0.65){
        return 'white';
    } else if ($s <= 0.15 && $v <= 0.65){ //gray shades are special since they make up 3 colors
        if ($v >= 0.6){
            $sh = 50;
        } else if ($v <= 0.25){
            $sh = -50;
        } else {
            $sh = 0;
        }
        
        return 'gray';
    } else if (($h <= 11 || $h >= 351) && $s >= 0.5 || ($h >= 310 && $h <= 351) && $s > 0.3){
        return 'red';
    } else if ($h <= 11 || $h >= 351 || ($h >= 310 && $h <= 351)){
        return 'pink';
    } else if ($h >= 11 && $h <= 45 && $v >= 0.3){
        return 'orange';
    } else if ($h >= 11 && $h <= 45 && $v <= 0.3){
        return 'brown';
    } else if ($h >= 45 && $h <= 64){
        return 'yellow';
    } else if ($h >= 64 && $h <= 170){
        return 'green';
    } else if ($h >= 170 && $h <= 255){
        return 'blue';
    } else if ($h >= 255 && $h <= 310 && $s >= 0.5){
        return 'purple';
    } else if ($h >= 255 && $h <= 310 && $s <= 0.5){
        return 'pink';
    }
}

?>
