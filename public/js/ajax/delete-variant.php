<?php 

require_once __DIR__ . "../../../../app/models/Item.php";
require_once __DIR__ . "/../../../app/utils/utils.php";

if (isset($_GET['item_id'])) {
    $id = $_GET['item_id'];

    $item_db = new Item();

    $item_db->deleteItem($id);
    // header("Location: ../../dashboard-admin.php");
     
} else {
    echo "false";
}

?>