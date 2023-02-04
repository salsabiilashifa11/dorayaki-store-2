<?php

require_once __DIR__ . '/../../../app/models/Cart.php';
require_once __DIR__ . "/../../../app/models/User.php";
require_once __DIR__ . "/../../../app/utils/cookies.php";
require_once __DIR__ . "/../../../app/utils/utils.php";

echo getUserCart();

function getUserCart() {
  $contextOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true,
     )
  );
  $sslContext = stream_context_create($contextOptions);
  $client = new SoapClient("../../../dorayakisupplier.wsdl", array('stream_context' => $sslContext));
  $response = $client->getRecipes();
  // var_dump($response);
  $array = json_decode(json_encode($response), true);
  $factory_items = $array["data"]["recipes"];

  $user_id = validateAuthCookie($_COOKIE);

  $item_template = file_get_contents(__DIR__ . '/../../html/template/factory-item-component.html');
  $items = '';
  foreach ($factory_items as $item) {
    $item_to_add = str_replace('{select-value}', $item["name"], $item_template);
    $item_to_add = str_replace('{select-label}', $item["name"], $item_to_add);
    
    $items .= $item_to_add;
  }

  return json_encode([json_encode($factory_items), $items, $factory_items]);
}
?>
