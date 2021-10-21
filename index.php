<?php

include __DIR__ . "/vendor/UploadFiles/UploadFiles.php";

use \UploadFiles\UploadFiles;

$file = new UploadFiles;

if (isset($_POST['upload'])) {
    echo $file->file($_FILES['file'])->image();
    
    /* 

    echo $file->file($_FILES['file'])->pdf();
    echo $file->file($_FILES['file'])->docx();
    echo $file->file($_FILES['file'])->xlsx();
    echo $file->file($_FILES['file'])->count_name(40)->path("files/images/")->ext(['jpg', 'pdf', 'docx'])->get(); 

    */
}

?>

<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="upload">
</form>