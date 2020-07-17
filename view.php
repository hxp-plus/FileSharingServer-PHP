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
    echo "<a href='";
    echo $doc;
    echo "'> --- Download this file --- </a>";
    echo "</div>";
endforeach;

?>

<script src="scripts/jquery.min.js"></script>
<script>
    console.time("Asynchronously");
    $(document).ready(function() {
        var queryDict = {};
        location.search.substr(1).split("&").forEach(function(item){queryDict[item.split("=")[0]] = item.split("=")[1]});
        var file_id = queryDict["id"];
        var i = 0;
        function next() {
            $.ajax({
                async: true,
                url: "get_page.php?id=" + file_id + "&q=" + i.toString(),
                success: function(r) {
                    ++i;
                    if (r !== "Image Not Found") {
                        $('body').append(r);
                        next();
                    }
                }
            });
        }
        next();
    });
    console.timeEnd("Asynchronously");
</script>