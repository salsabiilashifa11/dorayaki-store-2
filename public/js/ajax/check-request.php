<?php

require_once __DIR__ . '/../../../app/models/Item.php';
require_once __DIR__ . "/../../../app/models/User.php";
require_once __DIR__ . "/../../../app/utils/cookies.php";
require_once __DIR__ . "/../../../app/db/db.php";
require_once __DIR__ . "/../../../app/config/constants.php";

echo getUserRequests();

function getUserRequests() {
  $db = new Database();
  $item_db = new Item();
  $unconfirmed_table = DB_TABLE_UNCONFIRMED_REQUESTS;

  $contextOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true,
     )
  );
  $sslContext = stream_context_create($contextOptions);
  $client = new SoapClient("../../../dorayakisupplier.wsdl", array('stream_context' => $sslContext));
  $response = $client->getRequests("");

  $array = json_decode(json_encode($response), true);
  $request_items = $array["data"]["requests"];

  $user_id = validateAuthCookie($_COOKIE);

  $request_template = file_get_contents(__DIR__ . '/../../html/template/request-component.html');
  $requests = '';
  foreach ($request_items as $request) {
    $request_id = $request['id'];
    $request_to_add = str_replace('{request-id}', $request['id'], $request_template);
    $request_to_add = str_replace('{item-name}', $request['name'], $request_to_add);
    $request_to_add = str_replace('{qty}', $request['quantity'], $request_to_add);
    $request_to_add = str_replace('{status}', $request['status'], $request_to_add);
    $requests .= $request_to_add;

    //Get item and add stock in store database
    // $db->query("SELECT * FROM {$unconfirmed_table} WHERE request_id={$request_id}");
    // $result = $db->single();

    // if ($result) {
    //   $item = $item_db->getItemByName($request['name']);
    //   $new_stock = $request['quantity'];
    //   $data = array(
    //     "id"=>$item['id'],
    //     "name"=>$item['name'], 
    //     "description"=>$item['description'], 
    //     "price"=>$item['price'],
    //     "available_qty"=>$new_stock + $item['available_qty'],
    //     "img"=>$item['img']
    //   );
      
    //   if ($request['status']=='Accepted') {
    //     $item_db->editItem($data);
    //     $db->query("DELETE FROM {$unconfirmed_table} WHERE request_id={$request_id}");
    //     $db->execute();
    //   } else if ($request['status']=='Declined') {
    //     $db->query("DELETE FROM {$unconfirmed_table} WHERE request_id={$request_id}");
    //     $db->execute();
    //   }
      
    // }

  }

  return json_encode([json_encode($request_items), $requests, $request_items]); //Ga yakin
}
?>