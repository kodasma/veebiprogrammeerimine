<?php

$target_dir = "../../pics/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "Fail on pilt - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Fail ei ole pilt.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Vabandame, fail on juba olemas!";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 2000000) {
    echo "Vabandame, fail on liiga suur!";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Vabandame, ainult JPG, JPEG, PNG & GIF failid on lubatud!";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Vabandame, su faili ei laetud üles!";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Fail nimega ". basename( $_FILES["fileToUpload"]["name"]). " on üles laetud!";
    } else {
        echo "Vabandame, faili üles laadimisega tekkis probleem!";
    }
}
?>