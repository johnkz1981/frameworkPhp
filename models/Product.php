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