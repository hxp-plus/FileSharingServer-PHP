<?php
define("FILE_UPLOAD_PATH", "uploads/");
$file_id=strval($_GET["id"]);
$file_path = FILE_UPLOAD_PATH . $file_id;
if(!is_dir(strval($file_path))) {
    die("File is Missing");
}

$document = glob("{$file_path}/*.{pdf,doc,docx}", GLOB_BRACE);
foreach($document as $doc ):
    echo "<div class=\"container\">";
    echo "<a href=";
    echo $doc;
    echo "> --- Download this file --- </a>";
    echo "</div>";
endforeach;
$image_dir = "$file_path/img/*.png";
//get the list of all files with .jpg extension in the directory and safe it in an array named $images
$images = glob($image_dir);

//extract only the name of the file without the extension and save in an array named $find
foreach( $images as $image ):
    echo "<div class=\"container\">";
    echo "<img width=\"100%\" src='" . $image . "' />";
    echo "</div>";
endforeach;