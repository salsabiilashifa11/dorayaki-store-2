<?php 

if( $_FILES['file'] != "" ) {
    $path = $_FILES['file'];
    $pathto = './img/'.$path;
    move_uploaded_file($_FILES['file'], $pathto) or die( "Could not copy file!");
}
else {
    die("No file specified!");
}

?>