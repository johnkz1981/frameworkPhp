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

  public function getSqlInsert(): string
  {
    $tableName = $this->getTableName();
    $sql = "INSERT INTO {$tableName} (`name`, description, price, producer_id, category_id)";
    $sql .= " VALUES (:name, :description, :price, :producer_id, :category_id)";

    return $sql;
  }

  public function getSqlUpdate(): string
  {
    $tableName = $this->getTableName();
    $sql = "UPDATE {$tableName} SET name = :name, description = :description,";
    $sql .= "price = :price, producer_id = :producer_id, category_id = :category_id WHERE id = :id";

    return $sql;
  }

  public function getParams(object $object): array
  {
    return [
      ':id' => $object->id,
      ':name' => $object->name,
      ':description' => $object->description ?? '',
      ':price' => $object->price,
      ':producer_id' => $object->producer_id ?? 0,
      ':category_id' => $object->category_id ?? 0,
    ];
  }

  public function getRequiredFields(): array
  {
    return [
      'name', 'price'
    ];
  }
}