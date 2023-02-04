<?php 

require_once __DIR__ . "../../../../app/models/Item.php";
require_once __DIR__ . "/../../../app/utils/utils.php";
require_once __DIR__ . "/../../../app/db/db.php";
require_once __DIR__ . "/../../../app/config/constants.php";

$db = new Database();
$item_db = new Item();
$unconfirmed_table = DB_TABLE_UNCONFIRMED_REQUESTS;
 
if (isset($_POST['name']) and isset($_POST['stock'])) {
    $name = $_POST['name'];
    $requested_stock = $_POST['stock'];
    
    $contextOptions = array(
      'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true,
       )
    );
    $sslContext = stream_context_create($contextOptions);
    $client = new SoapClient("../../../dorayakisupplier.wsdl", array('stream_context' => $sslContext));
    $recipes_response = $client->getRecipes();
    $recipes_array = json_decode(json_encode($recipes_response), true);
    $recipes_items = $recipes_array["data"]["recipes"];
    
    $requested_id = 0;
    foreach ($recipes_items as $recipe) {
      debug_to_console("A: ".$recipe["name"]);
      debug_to_console("B: ".$name);
      if ($recipe['name'] == $name) {
        $requested_id = $recipe['id'];
        break;
      }
    }
    
    if ($requested_id != 0) {
      $params = array(
        "recipeId" => $requested_id,
        "quantity" => $requested_stock
      );
      $request_stock_response = $client->restockRequest($params);

      // Update stock
      // $request_stock_array = json_decode(json_encode($request_stock_response), true);
      // var_dump($request_stock_array);
      // $request_id = $request_stock_array["data"]["id"]; //Mungkin ganti namanya

      // $db->query("INSERT INTO {$unconfirmed_table} VALUES ({$request_id})");
      // $db->execute();
      // End update stock

      header("Location: ../../dashboard-admin.php");
    } else {
      header("Location: ../../dashboard-admin.php");
    }
    
} else {
  echo "false";
}

?>