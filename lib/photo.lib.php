<?php 

function image_resize($image_string, $crop = null, $size = null) {
    $image = ImageCreateFromString($image_string);

    if (is_resource($image) === true) {
        $x = 0;
        $y = 0;
        $width = imagesx($image);
        $height = imagesy($image);

        /*
        CROP (Aspect Ratio) Section
        */

        if (is_null($crop) === true) {
            $crop = array($width, $height);
        } else {
            $crop = array_filter(explode(':', $crop));

            if (empty($crop) === true) {
                    $crop = array($width, $height);
            } else {
                if ((empty($crop[0]) === true) || (is_numeric($crop[0]) === false)) {
                        $crop[0] = $crop[1];
                } else if ((empty($crop[1]) === true) || (is_numeric($crop[1]) === false)) {
                        $crop[1] = $crop[0];
                }
            }

            $ratio = array(0 => $width / $height, 1 => $crop[0] / $crop[1]);

            if ($ratio[0] > $ratio[1]) {
                $width = $height * $ratio[1];
                $x = (imagesx($image) - $width) / 2;
            }

            else if ($ratio[0] < $ratio[1]) {
                $height = $width / $ratio[1];
                $y = (imagesy($image) - $height) / 2;
            }

        }

        /*
        Resize Section
        */

        if (is_null($size) === true) {
            $size = array($width, $height);
        }

        else {
            $size = array_filter(explode('x', $size));

            if (empty($size) === true) {
                    $size = array(imagesx($image), imagesy($image));
            } else {
                if ((empty($size[0]) === true) || (is_numeric($size[0]) === false)) {
                        $size[0] = round($size[1] * $width / $height);
                } else if ((empty($size[1]) === true) || (is_numeric($size[1]) === false)) {
                        $size[1] = round($size[0] * $height / $width);
                }
            }
        }

       $result = ImageCreateTrueColor($size[0], $size[1]);

        if (is_resource($result) === true) {
            ImageSaveAlpha($result, true);
            ImageAlphaBlending($result, true);
            ImageFill($result, 0, 0, ImageColorAllocate($result, 255, 255, 255));
            ImageCopyResampled($result, $image, 0, 0, $x, $y, $size[0], $size[1], $width, $height);

            ImageInterlace($result, true);
            
            $temp_file = tempnam(sys_get_temp_dir(), 'img');
            ImageJPEG($result, $temp_file, 90);
            
            $image_str = file_get_contents($temp_file);
            unlink($temp_file);
            return $image_str;

        }
    }

    return false;
}
