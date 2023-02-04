<?php 

require_once __DIR__ . "/../../../app/models/Item.php";
require_once __DIR__ . "/../../../app/models/User.php";
require_once __DIR__ . "/../../../app/utils/cookies.php";

$item_db = new Item();
$lim = 8;

$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// count total pages
$item_count = $item_db->countVariants($search);
$page_total = ceil($item_count / $lim);

$page = 1;
if (isset($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $page_total) {
  $page = $_GET['page'];
} 

// load item to array
$item_arr = $item_db->getItemsPagination($search, $page, $lim);

// generate card
$card_template = file_get_contents(__DIR__ . "/../../html/template/card.html");
$cards = '';

$id = validateAuthCookie($_COOKIE);
$user = new User();
$role = $user->getRoleById($id);

foreach ($item_arr as $item) {
    $new_card_template = str_replace('{item-detail}', "./detail-{$role}.php?item_id={$item['id']}", $card_template);
    $new_card_template = str_replace('{product-img}', $item['img'], $new_card_template);
    $new_card_template = str_replace('{product-name}', $item['name'], $new_card_template);
    $new_card_template = str_replace('{product-price}', 'Rp' . number_format($item['price'] ,0,',','.'), $new_card_template);
    $new_card_template = str_replace('{product-sold}', $item['sold_qty'], $new_card_template);
    $cards .= $new_card_template;
}

// generate pagination
$page_template = file_get_contents(__DIR__ . "/../../html/template/pagination.html");

$page_component = "";

if ($page_total > 1) {
  // left arrow
  $min_page = $page-1;
  if ($min_page < 1) {
    $min_page = 1;
  }
  $new_page_template = str_replace('{page-content}', '&laquo;', $page_template);
  $new_page_template = str_replace('{page}', $min_page, $new_page_template);
  $page_component .= $new_page_template;

  // pages
  for ($i = 1; $i <= $page_total; $i++) {
    $new_page_template = str_replace('{page-content}', $i, $page_template);
    $new_page_template = str_replace('{page}', $i, $new_page_template);
    if ($i == $page) {
      $new_page_template = str_replace('{is-active}', 'active', $new_page_template);
    }
    $page_component .= $new_page_template;
  }

  // right arrow
  $max_page = $page+1;
  if ($max_page > $page_total) {
    $max_page = $page_total;
  }
  $new_page_template = str_replace('{page-content}', '&raquo;', $page_template);
  $new_page_template = str_replace('{page}', $max_page, $new_page_template);
  $page_component .= $new_page_template;
}

echo json_encode([$cards, $page_component, $_GET['search']]);
?>