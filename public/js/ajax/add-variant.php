<?php 

require_once __DIR__ . "../../../../app/models/Item.php";

$target_path = "./../../img//";
$file_name = $_FILES['image']['name'];
$target_path = $target_path . $_FILES['image']['name']; 

if( $target_path != "" ) {
  move_uploaded_file($_FILES['image']['tmp_name'], $target_path) or die("Could not copy file!: ".$target_path);
}
else {
  die("No file specified!");
}

if (isset($_POST['factory-item-name']) and isset($_POST['detail'])
and isset($_POST['price']) and isset($_POST['stock'])) {
    $name = $_POST['factory-item-name'];
    $description = $_POST['detail'];
    $price = $_POST['price'];
    $available_qty = $_POST['stock'];
    $img = $_POST['image'];

    $data = array(
      "name"=>$name, 
      "description"=>$description, 
      "price"=>$price,
      "available_qty"=>$available_qty,
      "img"=>"/".$file_name
    );

    $item_db = new Item();

    if ($item_db->createItem($data)) {
        header("Location: ../../dashboard-admin.php");
    } 
    else {
        echo "false here";
    }
} else {
  echo "false";
}

?>