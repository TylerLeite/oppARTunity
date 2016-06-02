<?php

function resize($src){
    list($wdt, $hgt, $type) = getimagesize($src);
    switch ($type) {
        case IMAGETYPE_GIF:
            $srcImg = imagecreatefromgif($src);
            break;
        case IMAGETYPE_JPEG:
            $srcImg = imagecreatefromjpeg($src);
            break;
		case IMAGETYPE_JPG:
			$srcImg = imagecreatefromjpeg($src);
			break;
        case IMAGETYPE_PNG:
            $srcImg = imagecreatefrompng($src);
            break;
    }
    
    if ($srcImg === false) {
        return false;
    }
    
    $srcAspectRatio = $wdt / $hgt;
    $thumbAspectRatio = 1;
    if ($wdt <= 150 && $hgt <= 150) {
        $thumbWdt = $wdt;
        $thumbHgt = $hgt;
    } else if ($thumbAspectRatio > $srcAspectRatio) {
        $thumbWdt = (int) (150 * $srcAspectRatio);
        $thumbHgt = 150;
    } else {
        $thumbWdt = 150;
        $thumbHgt = (int) (150 / $srcAspectRatio);
    }
    
    $thumbImg = imagecreatetruecolor($thumbWdt, $thumbHgt);
    imagecopyresampled($thumbImg, $srcImg, 0, 0, 0, 0, $thumbWdt, $thumbHgt, $wdt, $hgt);
    
    unlink($src);
    $fname = explode('.', $src);
    $src = $fname[0] . '.png';
    
    imagepng($thumbImg, $src);
    imagedestroy($srcImg);
    imagedestroy($thumbImg);
    
    return $src;
}

?>
