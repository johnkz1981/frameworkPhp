<?php

namespace app\models;

class Product extends Records
{
  public $id;
  public $name;
  public $description;
  public $price;
  public $producer_id;
  public $category_id;

  public function __construct($id = null, $name = null, $description = null, $price = null,
                              $producer_id = null, $category_id = null)
  {
    parent::__construct();

    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->price = $price;
    $this->producer_id = $producer_id;
    $this->category_id = $category_id;
  }

  public static function getTableName(): string
  {
    return 'products';
  }
}