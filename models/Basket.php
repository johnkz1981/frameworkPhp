<?php
namespace app\models;

class Basket extends Model
{
  public $id;
  public $product_id;
  public $customer_id;
  public $discount;

  public function getTableName(): string
  {
    return 'baskets';
  }
}