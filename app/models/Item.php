<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../utils/utils.php';
require_once __DIR__ . '/../config/constants.php';

class Item
 {
  // Nama
  // Deskripsi
  // Harga
  // Stok
  // Gambar
  private $table = DB_TABLE_ITEMS;
  private $db;

  public function __construct()
   {
    $this->db = new Database();
   }

  public function getItemById($id)
   {
    $this
      ->db
      ->query("SELECT * FROM {$this->table} WHERE id = :id");
    $this
      ->db
      ->bind(':id', $id);
    $result = $this
      ->db
      ->single();
    return $result;
   }

   public function getItemByName($name)
   {
    $this
      ->db
      ->query("SELECT * FROM {$this->table} WHERE name = :name");
    $this
      ->db
      ->bind(':name', $name);
    $result = $this
      ->db
      ->single();
    return $result;
   }

  public function getItemsPagination($query = '', $page = 1, $limit = 8, $sort = 'DESC', $order_by = 'sold_qty')
   {
    $offset = ($page - 1) * $limit;

    $this
      ->db
      ->query("SELECT * FROM {$this->table} WHERE name LIKE :query ORDER BY $order_by 
         $sort LIMIT :limit OFFSET :offset");

    $this
      ->db
      ->bind(':limit', $limit);
    $this
      ->db
      ->bind(':offset', $offset);
    $this
      ->db
      ->bind(':query', "%$query%");

    $result = $this
      ->db
      ->resultSet();

    return $result;
   }

  /**
   * createItem is a methods that adds a new item to the database.
   *
   * @param array $data The data to be added to the database.
   * The structure of data is as follows:
   * $data = [
   * 'name' => string,
   * 'description' => string,
   * 'price' => integer,
   * 'available_qty' => integer,
   * 'img' => string (the file name in folder img/dorayaki/)
   * ];
   * @return int|bool the id of the new variant or false if the insert failed.
   */

  public function createItem($data)
   {
    if (empty($data) || !isset($data['name']) || !isset($data['description']) || !isset($data['price']) || !isset($data['available_qty']) || !isset($data['img']))
     {
      return false;
     }

    $this
      ->db
      ->query("INSERT INTO {$this->table} (name, description, price, available_qty, img)
         VALUES (:name, :description, :price, :available_qty, :img)");

    $this
      ->db
      ->bind(':name', $data['name']);
    $this
      ->db
      ->bind(':description', $data['description']);
    $this
      ->db
      ->bind(':price', $data['price']);
    $this
      ->db
      ->bind(':available_qty', $data['available_qty']);
    $this
      ->db
      ->bind(':img', $data['img']);

    $id = $this
      ->db
      ->lastInsertId();

    if (!empty($id))
     {
      return $id;
     }
    else
     {
      return false;
     }
   }

   public function editItem($data) {
    if (empty($data) || !isset($data['name']) || !isset($data['description']) || !isset($data['price']) || !isset($data['available_qty']) || !isset($data['img']))
     {
      return false;
     }

    $this
      ->db
      ->query("UPDATE {$this->table} SET name = :name, description =:description, price =  :price, available_qty = :available_qty, img = :img
       WHERE id = :id");

    $this
      ->db
      ->bind(':name', $data['name']);
    $this
      ->db
      ->bind(':description', $data['description']);
    $this
      ->db
      ->bind(':price', $data['price']);
    $this
      ->db
      ->bind(':available_qty', $data['available_qty']);
    $this
      ->db
      ->bind(':img', $data['img']);
    $this
      ->db
      ->bind(':id', $data['id']);

    return $this->db->execute();
   }

  public function deleteItem($id)
   {
    $this
      ->db
      ->query("DELETE FROM {$this->table} WHERE id = :id");
    $this
      ->db
      ->bind(':id', $id);

    $result = $this
      ->db
      ->execute();
    return $result;
   }

  public function countVariants($query = '')
   {
    $this
      ->db
      ->query("SELECT COUNT(*) FROM {$this->table} WHERE name LIKE :query");
    $this
      ->db
      ->bind(':query', "%$query%");

    return $this
      ->db
      ->rowCount();
   }

 }
?>
