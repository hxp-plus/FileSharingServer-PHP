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

//$image_dir = "$file_path/img/*.png";
////get the list of all files with .jpg extension in the directory and safe it in an array named $images
//$images = glob($image_dir);
//
////extract only the name of the file without the extension and save in an array named $find
//foreach( $images as $image ):
//    echo "<div class=\"container\">";
//    echo "<img width=\"100%\" src='" . $image . "' />";
//    echo "</div>";
//endforeach;

//$q = $_REQUEST["q"];
//if ($q != "") {
//    echo "q=" . strval($q);
//    $required_img = glob("$file_path/img/output-" . $q . ".png");
//    if($required_img) {
//        echo "<div class=\"container\">";
//        echo "<img width=\"100%\" src='" . $required_img[0] . "' />";
//        echo "</div>";
//    }
//}
?>

<script src="scripts/jquery.min.js"></script>
<script>

    // $(document).ready(function(){
    //     alert("Document Ready");
    //     var queryDict = {};
    //     location.search.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] = item.split("=")[1]});
    //     var file_id = queryDict["id"];
    //
    //     var i = 0;
    //     while(true) {
    //         var return_first = function () {
    //             var tmp = null;
    //             $.ajax({
    //                 'async': false,
    //                 'type': "POST",
    //                 'global': false,
    //                 'dataType': 'html',
    //                 'url': "/get_page.php?id=" + file_id + "&q=" + i.toString(),
    //                 'data': { 'request': "", 'target': 'arrange_url', 'method': 'method_target' },
    //                 'success': function (data) {
    //                     tmp = data;
    //                 }
    //             });
    //             return tmp;
    //         }();
    //         if (return_first !== "Image Not Found") {
    //             $("body").append(return_first);
    //             i++;
    //         } else {
    //             break;
    //         }
    //     }
    // });

    $(document).ready(function() {
        var queryDict = {};
        location.search.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] = item.split("=")[1]});
        var file_id = queryDict["id"];
        var i = 0;
        // run 5 consecutive ajax calls
        // when the first one finishes, run the second one and so on
        function next() {
            $.ajax({
                async: true,
                url: "/get_page.php?id=" + file_id + "&q=" + i.toString(),
                success: function(r) {
                    //console.log(r); //this works
                    ++i;
                    if (r !== "Image Not Found") {
                        $('body').append(r); //this happens all at once
                        next();
                    }

                }
            });
        }
        next();
    });
</script>