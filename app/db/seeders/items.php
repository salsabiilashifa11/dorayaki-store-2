<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../../config/constants.php';

$db = new Database();

$db->query("INSERT INTO " . DB_TABLE_ITEMS . " (name, description, price, available_qty, img)
 VALUES (:name, :description, :price, :available_qty, :img)");

$db->bind(':name', 'Dorayaki Belgian Max Choco');
$db->bind(':description', '2 slices japanese grill cake that filling with begian chocolate by celine inside');
$db->bind(':price', 12000);
$db->bind(':available_qty', 100);
$db->bind(':img', '/1.jpeg');

$db->execute();

$db->bind(':name', 'Dorayaki Crunchy Cream');
$db->bind(':description', '2 slices japanese grill cake that filling with ovomaltine inside');
$db->bind(':price', 12000);
$db->bind(':available_qty', 100);
$db->bind(':img', '/2.jpeg');

$db->execute();

$db->bind(':name', 'Dorayaki Almond Chocolate');
$db->bind(':description', '2 slices japanese grill cake that filling with chocolate and almond inside');
$db->bind(':price', 12000);
$db->bind(':available_qty', 100);
$db->bind(':img', '/3.jpeg');

$db->execute();

$db->bind(':name', 'Dorayaki Griffin Chocolate');
$db->bind(':description', '2 slices japanese grill cake that filling with mix chocolte and butter inside');
$db->bind(':price', 12000);
$db->bind(':available_qty', 100);
$db->bind(':img', '/4.jpeg');

$db->execute();

$db->bind(':name', 'Dorayaki Hazelnut Crunchy');
$db->bind(':description', '2 slices japanese grill cake that filling with almond and chocolate inside');
$db->bind(':price', 12000);
$db->bind(':available_qty', 100);
$db->bind(':img', '/5.jpeg');

$db->execute();

$db->bind(':name', 'Dorayaki Double Cheese');
$db->bind(':description', '2 slices japanese grill cake that filling with kraft ceese that shredded inside');
$db->bind(':price', 12000);
$db->bind(':available_qty', 100);
$db->bind(':img', '/6.jpeg');

$db->execute();

$db->bind(':name', 'Dorayaki Cheesy Chocolate');
$db->bind(':description', '2 slices japanese grill cake that filling with kraft ceese that shredded and chocolate inside');
$db->bind(':price', 12000);
$db->bind(':available_qty', 100);
$db->bind(':img', '/7.jpeg');

$db->execute();

$db->bind(':name', 'Dorayaki Cheese O');
$db->bind(':description', '2 slices japanese grill cake that filling with oreo and kraft cheese inside');
$db->bind(':price', 12000);
$db->bind(':available_qty', 100);
$db->bind(':img', '/8.jpeg');

$db->execute();

$db->bind(':name', 'Dorayaki Hokkaido Red Bean');
$db->bind(':description', '2 slices japanese grill cake that filling with celine homemade red bean inside');
$db->bind(':price', 12000);
$db->bind(':available_qty', 100);
$db->bind(':img', '/9.jpeg');

$db->execute();

$db->bind(':name', 'Dorayaki Milky Oreo');
$db->bind(':description', '2 slices japanese grill cake that filling with mix milk and crunch oreo inside');
$db->bind(':price', 12000);
$db->bind(':available_qty', 100);
$db->bind(':img', '/10.jpeg');

$db->execute();

$db->bind(':name', 'Dorayaki Greentea Matcha');
$db->bind(':description', '2 slices japanese grill cake that filling with celine matcha jam inside');
$db->bind(':price', 12000);
$db->bind(':available_qty', 100);
$db->bind(':img', '/11.jpeg');

$db->execute();

$db->bind(':name', 'Dorayaki Tiramisu');
$db->bind(':description', '2 slices japanese grill cake that filling with celine tiramisu jam inside');
$db->bind(':price', 12000);
$db->bind(':available_qty', 100);
$db->bind(':img', '/12.jpeg');

$db->execute();

$db->bind(':name', 'Dorayaki Peanut Butter');
$db->bind(':description', '2 slices japanese grill cake that filling with buter and peanut inside');
$db->bind(':price', 12000);
$db->bind(':available_qty', 100);
$db->bind(':img', '/13.jpeg');

$db->execute();

?>