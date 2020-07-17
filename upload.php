<?php
define("MAX_RAND_NUMBER", 100000000);
define("FILE_UPLOAD_PATH", "uploads/");
define("FILE_BASE_URL", "http://localhost:8080/view.php?id=");

$file_id = strval(rand(MAX_RAND_NUMBER/10,MAX_RAND_NUMBER));
$file_path = FILE_UPLOAD_PATH . $file_id;
while(is_dir($file_path)) {
    $file_id = strval(rand(MAX_RAND_NUMBER/10,MAX_RAND_NUMBER));
    $file_path = FILE_UPLOAD_PATH . $file_id;
}

$target_file = $file_path . "/" . basename($_FILES["fileToUpload"]["name"]);
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Allow certain file formats
if($FileType != "pdf" && $FileType != "docx" && $FileType != "doc") {
    die(json_encode([ 'success' => false, 'msg'=> "Only pdf doc and docx are supported" ]));
}

mkdir($file_path . "/img/",0777,true);
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
//    echo "id:" . strval($file_path) . "<br>";
//    echo "Processing File...<br>";
    exec("convert -density 300 -depth 8 -quality 90 \"" . $target_file . "\" " . $file_path ."/img/output.png");
//    echo "Finished!<br>";
//    echo "File link: <a href=" . FILE_BASE_URL . $file_id.  ">" . FILE_BASE_URL . $file_id . "</a>";
    $msg = FILE_BASE_URL . $file_id;
    die(json_encode([ 'success'=> true , 'msg'=> $msg]));
} else {
    die(json_encode([ 'success' => false, 'msg'=> "Sorry, there was an error uploading your file." ]));
}