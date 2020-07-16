<?php
define("FILE_UPLOAD_PATH", "uploads/");
$file_id=strval($_GET["id"]);
$file_path = FILE_UPLOAD_PATH . $file_id;

$q = $_REQUEST["q"];

if ($q != "") {
    if($q == -1) {
        echo sizeof(glob("$file_path/img/output-*.png"));
    } else {
        $required_img = glob("$file_path/img/output-" . $q . ".png");
        if($required_img) {
            echo "<div class=\"container\">";
            echo "<img width=\"100%\" src='" . $required_img[0] . "' />";
            echo "</div>";
        } else {
            echo "Image Not Found";
        }
    }
}