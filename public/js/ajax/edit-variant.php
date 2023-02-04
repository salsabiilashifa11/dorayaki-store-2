<?php 

require_once __DIR__ . "../../../../app/models/Item.php";

$item_db = new Item();

$target_path = "./../../img//";
$file_name = $_FILES['image']['name'];
$target_path = $target_path . $_FILES['image']['name']; 

if( $target_path != "./../../img//" ) {
  move_uploaded_file($_FILES['image']['tmp_name'], $target_path) or die("Could not copy file!: ".$target_path);
}
 
if (isset($_POST['name']) and isset($_POST['detail'])
and isset($_POST['price']) and isset($_POST['stock'])) {
    $itemId = $_POST['item-id'];
    $name = $_POST['name'];
    $description = $_POST['detail'];
    $price = $_POST['price'];
    $available_qty = $_POST['stock'];
    if ($file_name != "") {
      $img = "/".$file_name;
    }
    else {
      $img = $item_db->getItemById($itemId)['img'];
    }

    $data = array(
      "id"=>$itemId,
      "name"=>$name, 
      "description"=>$description, 
      "price"=>$price,
      "available_qty"=>$available_qty,
      "img"=>$img
    );

    if ($item_db->editItem($data)) {
        header("Location: ../../dashboard-admin.php");
    } 
    else {
      echo "Error";
    }
} else {
  echo "false";
}

?>