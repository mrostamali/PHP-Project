<?php 

function correctImageOrientation($filename,$filetype) {
    if (function_exists('exif_read_data')) {
        $exif = exif_read_data($filename);
        if($exif && isset($exif['Orientation'])) {
            $orientation = $exif['Orientation'];
            if($orientation != 1){
            // if($filetype == "jpg"){$img = imagecreatefromjpeg($filename);}
            // if($filetype == "png"){$img = imagecreatefrompng($filename);;} 
            $img = imagecreatefromjpeg($filename);
            $deg = 0;
            switch ($orientation) {
                case 3:
                $deg = 180;
                break;
                case 6:
                $deg = 270;
                break;
                case 8:
                $deg = 90;
                break;
            }
            if ($deg) {
                $img = imagerotate($img, $deg, 0);        
            }
            // then rewrite the rotated image back to the disk as $filename 
            imagejpeg($img, $filename, 95);
            // if($filetype == "jpg"){imagejpeg($img, $filename, 95);}
            // if($filetype == "png"){imagepng($img, $filename, 95);} 
            } // if there is some rotation necessary
        } // if have the exif orientation info
    } // if function exists      
}



//custom function to create thumbnail images (copies of originals); can be used for thumbnails (small copies) and display size as well.
function createThumbnail($file, $folder, $newwidth, $filetype){
    list($width, $height) = getimagesize($file);
    $imgRatio = $width/$height;
    $newheight = $newwidth/$imgRatio;

    //echo "<p><b>Width/Height:</b> ". $newwidth. "|" .$newheight ."</p>";
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    if($filetype == "jpg"){
        $source = imagecreatefromjpeg($file);
        imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        $newFileName = $folder . basename($file);
        imagejpeg($thumb, $newFileName, 80);  // 80 is going to be a quality of your new jpeg image
        imagedestroy($thumb);
        imagedestroy($source);
    }if($filetype == "png"){
        $source = imagecreatefrompng($file);
        imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        $newFileName = $folder . basename($file);
        imagepng($thumb, $newFileName, 8);  // 80 is going to be a quality of your new jpeg image
        imagedestroy($thumb);
        imagedestroy($source);
    }
    
}  


function createSquareImageCopy($file, $folder, $newWidth, $filetype){
        
    //echo "$filename, $folder, $newWidth";
    //exit();

    $thumb_width = $newWidth;
    $thumb_height = $newWidth;// tweak this for ratio

    list($width, $height) = getimagesize($file);

    $original_aspect = $width / $height;
    $thumb_aspect = $thumb_width / $thumb_height;

    if($original_aspect >= $thumb_aspect) {
    // If image is wider than thumbnail (in aspect ratio sense)
    $new_height = $thumb_height;
    $new_width = $width / ($height / $thumb_height);
    } else {
    // If the thumbnail is wider than the image
    $new_width = $thumb_width;
    $new_height = $height / ($width / $thumb_width);
    }

    if($filetype == "jpg"){
        $source = imagecreatefromjpeg($file);
        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
    
        // Resize and crop
        imagecopyresampled($thumb,
                        $source,0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                        0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                        0, 0,
                        $new_width, $new_height,
                        $width, $height);
    
        $newFileName = $folder. "/" .basename($file);
        imagejpeg($thumb, $newFileName, 80);
        echo "<p><img src=\"$newFileName\" /></p>"; // if you want to see the image
    }if($filetype == "png"){
        $source = imagecreatefrompng($file);
        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
    
        // Resize and crop
        imagecopyresampled($thumb,
                        $source,0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                        0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                        0, 0,
                        $new_width, $new_height,
                        $width, $height);
    
        $newFileName = $folder. "/" .basename($file);
        imagepng($thumb, $newFileName, 8);
        echo "<p><img src=\"$newFileName\" /></p>"; // if you want to see the image
    }   
}


function isEmbeddableYoutubeURL($url) {

    // Let's check the host first
    //$parse = parse_url($url);
    
    // if (!in_array($parse, array('youtube.com', 'www.youtube.com'))) {
    //     return false;
    // }

    $ch = curl_init();
    $oembedURL = 'www.youtube.com/oembed?url=' . urlencode($url).'&format=json';
    curl_setopt($ch, CURLOPT_URL, $oembedURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($output);

    if (!$data) return false; // Either 404 or 401 (Unauthorized)
    if (!$data->{'<iframe></iframe>'}) return false; // Embeddable video MUST have 'html' provided 

    return true;
}


?>