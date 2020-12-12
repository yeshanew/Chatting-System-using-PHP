<?php
//include('db.php');
error_reporting(0);
session_start();
$session_id='1'; //$session id
$path = "uploads/";

function getExtension($str)
{
    $i = strrpos($str, ".");
    if (!$i) {
        return "";
    }

    $l = strlen($str) - $i;
    $ext = substr($str, $i+1, $l);
    return $ext;
}

    $valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_FILES['photo']['name'];
    $size = $_FILES['photo']['size'];
            
    if (strlen($name)) {
        $ext = getExtension($name);
        if (in_array($ext, $valid_formats)) {
            if ($size<(1024*1024)) {
                require_once('class.ImageFilter.php');
                $filter = new ImageFilter;
                $score = $filter->GetScore($_FILES['photo']['tmp_name']);
                            
                if (isset($score)) {
                    if ($score >= 40) {
                        echo "Image scored ".$score."%, It seems that you have uploaded a nude picture :-(";
                    } else {
                            
                        //---------
                        $actual_image_name = time().".".$ext;
                        $tmp = $_FILES['photo']['tmp_name'];
                        if (move_uploaded_file($tmp, $path.$actual_image_name)) {
                            mysqli_query($connection, "UPDATE chat_images SET profile_image='$actual_image_name' WHERE id='$session_id'");
                                    
                            echo "<img src='uploads/".$actual_image_name."'  class='preview'>";
                        } else {
                            echo "Fail upload folder with read access.";
                        }
                        //--------
                    }
                }
            } else {
                echo "Image file size max 1 MB";
            }
        } else {
            echo "Invalid file format..";
        }
    } else {
        echo "Please select image..!";
    }
                
    exit;
}
