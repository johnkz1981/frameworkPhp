<?php
namespace app\models\repositories;

use app\models\Product;

class ProductRepository extends Repository
{
  public function getTableName(): string
  {
    return 'products';
  }

  public function getEntityClass(): string
  {
    return Product::class;
  }
}