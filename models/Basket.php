<?php

namespace app\models;

use app\base\App;
use app\models\repositories\ProductRepository;

class Basket extends Records
{
  public $id;
  public $product_id;
  public $customer_id;
  public $discount;

  public function getAll()
  {
    $basket = [];
    $session = App::call()->session;

    if (!empty($session->getAllOfDirectory('basket'))) {

      $productsIds = array_keys($session->getAllOfDirectory('basket'));
      $products = (new ProductRepository)->getProductsByIds($productsIds);

      foreach ($products as $product) {

        $basket[] = [
          'product' => $product,
          'count' => $session->get(['basket', $product->id])
        ];
      }
    }
    return $basket;
  }

  public function add($productId, $productQty)
  {
    $session = App::call()->session;
    $arrKey = ['basket', $productId];

    if ($session->get($arrKey)) {

      $session->set($arrKey, $session->get($arrKey) + (int)$productQty);
    } else {

      $session->set($arrKey, (int)$productQty);
    }
  }

  public function remove($productId){

    $session = App::call()->session;
    $arrKey = ['basket', $productId];

    if ($session->get($arrKey)) {

      $session->unSet($arrKey);
    }
  }
}