<?php

namespace app\models;

class Order extends Model
{
  public $id;
  public $customer_id;
  public $total_amount;
  public $array_products;
  public $discount;

  public function getTableName(): string
  {
    return 'orders';
  }
}