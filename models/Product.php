<?php
namespace app\models;

class Product extends Model
{
  public $id;
  public $name;
  public $description;
  public $price;
  public $producer_id;
  public $category_id;

  public function getTableName(): string
  {
    return 'products';
  }

  public function remove(int $id): int
  {
    $tableName = $this->getTableName();
    $sql = "DELETE FROM {$tableName} WHERE id = :id";

    return $this->db->execute($sql, [':id' => $id]);
  }

  public function change(object $object): int
  {
    $object = (object)array_merge((array)$this->getOne($object->id), (array)$object);

    $tableName = $this->getTableName();
    $sql = "UPDATE {$tableName} SET name = :name, description = :description,";
    $sql .= "price = :price, producer_id = :producer_id, category_id = :category_id WHERE id = :id";

    return $this->db->execute($sql, [
      ':id' => $object->id,
      ':name' => $object->name,
      ':description' => $object->description,
      ':price' => $object->price,
      ':producer_id' => $object->producer_id,
      ':category_id' => $object->category_id,
    ]);
  }

  public function create(object $object): int
  {
    if(!isset($object->name) || !isset($object->price)) {
      echo 'Поля name и price обязательны!';
      exit;
    }

    $tableName = $this->getTableName();
    $sql = "INSERT INTO {$tableName} (`name`, description, price, producer_id, category_id)";
    $sql .= " VALUES (:name, :description, :price, :producer_id, :category_id)";

    return $this->db->execute($sql, [
      ':name' => $object->name,
      ':description' => $object->description ?? '',
      ':price' => $object->price,
      ':producer_id' => $object->producer_id ?? 0,
      ':category_id' => $object->category_id ?? 0,
    ]);
  }
}