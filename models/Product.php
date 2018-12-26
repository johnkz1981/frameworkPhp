<?php

namespace app\models;

use app\models\repositories\ProductRepository;

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
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->price = $price;
    $this->producer_id = $producer_id;
    $this->category_id = $category_id;
  }

  public function getProducts($order){

    $productObj = new \stdClass();
    $productParse = [];
    $productsIds = array_keys($order);
    $products = (new ProductRepository)->getProductsByIds($productsIds);

    foreach ($products as $key => $product){

      $productObj->count = ((array)json_decode($order->products))[$product->id];
      $productObj->name = $product->name;
      $productParse[] = $productObj;
    }
    return $productParse;
  }
}