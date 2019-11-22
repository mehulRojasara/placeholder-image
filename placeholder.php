<?php
    $directory = "images";
    $images = glob($directory . "/*");
    $HtmlFiles = glob("./" . "/*.html");
    $imageName;

    function replace_string_in_file($filename, $string_to_replace, $replace_with){
        $content=file_get_contents($filename);
        $content_chunks=explode($string_to_replace, $content);
        $content=implode($replace_with, $content_chunks);
        file_put_contents($filename, $content);
    }

    foreach($images as $image)
    {
        foreach($HtmlFiles as $HtmlFile)
        {
            $filename = substr($HtmlFile, strrpos($HtmlFile, '/') + 1);
            $string_to_replace = $image;
            $image_info = getimagesize($image);
            $replace_with = "https://via.placeholder.com/" . $image_info[0]. 'x' . $image_info[1];
            $file = file_get_contents($filename);
         
            if(strpos($file, $string_to_replace)) 
            {
                replace_string_in_file($filename, $string_to_replace, $replace_with);
            }else{ 
                echo "<span>Not Found!<strong> " . $string_to_replace . "</strong></span><br/>"; 
            }
        }
    }
?>