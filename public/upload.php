<?php 

if( $_FILES['file']['name'] != "" ) {
    $path = $_FILES['image']['name'];
    $pathto = '/img/'.$path;
    move_uploaded_file( $_FILES['image']['tmp_name'],$pathto) or die( "Could not copy file!");
}
else {
    die("No file specified!");
}

?>