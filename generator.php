<?php

    //Set the Content Type
    header('Content-type: image/jpeg');
    function PIPHP_ImageResize($image, $w, $h)
    {
        $oldw = imagesx($image);
        $oldh = imagesy($image);
        $temp = imagecreatetruecolor($w, $h);
        imagecopyresampled($temp, $image, 0, 0, 0, 0, $w, $h, $oldw, $oldh);
        return $temp;
    }


    $backgroundPath = $_FILES["backgroundFile"]["tmp_name"];
    $img = @imagecreatefrompng('valentins.png');
    $width  = imagesx($img);
    $height = imagesy($img);
    //create new image and fill with background color
    $backgroundImg = @imagecreatefrompng($backgroundPath);
    $imgCreateMethods = [
        'imagecreatefromjpeg',
        'imagecreatefrompng',
        'imagecreatefromgd',
        'imagecreatefromgif',
        'imagecreatefrombmp',
        'imagecreatefromwbmp',
        'imagecreatefromwebp',
        'imagecreatefromstring',
    ];
    foreach($imgCreateMethods as $method)
    {
        if(!$backgroundImg)
        {
            $backgroundImg = @$method($backgroundPath);
        }
    }

    $backgroundImg = PIPHP_ImageResize($backgroundImg, $width, $height);

    //copy original image to background
    imagecopy($backgroundImg, $img, 0, 0, 0, 0, $width, $height);
    
    // Allocate A Color For The Text
    //$black = imagecolorallocate($backgroundImg, 0, 0, 0);
    // Set Path to Font File
    //$font_path = 'font.ttf';
    // Set Text to Be Printed On Image
    //$text = $_POST["valentinsDara"];
    // Print Text On Image
    //imagettftext($backgroundImg, 10, 0, 70, 479, $black, $font_path, $text);
    //save as png
    imagepng($backgroundImg);
?>
