<?php

function mapColorToCSS($shade, $color){
    switch ($shade){
        case 'light':
            switch ($color){
                case 'black':
                    return 'Black';
                case 'blue':
                    return 'LightBlue';
                case 'brown':
                    return 'RosyBrown';  
                case 'gray':
                    return 'LightGray';
                case 'green':
                    return 'LightGreen';
                case 'orange':
                    return 'SandyBrown';
                case 'pink':
                    return 'LightPink';
                case 'purple':
                    return 'MediumOrchid';
                case 'red':
                    return 'Tomato';
                case 'white':
                    return 'White';
                case 'yellow':
                    return 'Wheat';
                default:
                    return $color;
            }
            break;
        case 'dark':
            switch ($color){
                case 'black':
                    return 'Black';
                case 'blue':
                    return 'MidnightBlue';
                case 'brown':
                    return 'SaddleBrown';      
                case 'gray':
                    return 'DimGray';   
                case 'green':
                    return 'DarkGreen';
                case 'orange':
                    return 'DarkOrange';  
                case 'pink':
                    return 'Fuscia';
                case 'purple':
                    return 'DeepMagenta';
                case 'red':
                    return 'DarkRed';
                case 'white':
                    return 'White';  
                case 'yellow':
                    return 'GoldenRod';
                default:
                    return $color;
            }
            break;
        case 'normal':
            switch ($color){
                case 'brown':
                    return 'Sienna';
                default:
                    return $color;
            }
        default:
            return $color;
    }
}

?>
