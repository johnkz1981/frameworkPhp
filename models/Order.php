<?php

namespace app\models;

use app\base\App;
use app\models\repositories\OrderRepository;

class Order extends Records
{
  public $id;
  public $products;
  public $user_id;
  public $address;
  public $phone;

  /**
   * Order constructor.
   * @param $id
   * @param $products
   * @param $user_id
   * @param $address
   * @param $phone
   */
  public function __construct($id = null, $products = null, $user_id = null, $address = null, $phone = null)
  {
    $this->id = $id;
    $this->products = $products;
    $this->user_id = $user_id;
    $this->address = $address;
    $this->phone = $phone;
  }

  public function add($basket, $address, $phone, $user_id)
  {
    $this->products = json_encode($basket);
    $this->user_id = $user_id;
    $this->address = $address;
    $this->phone = $phone;

    (new OrderRepository())->insert($this);
  }

  public function getOrders()
  {
    $orders = [];

    foreach ((new OrderRepository())->getAll() as $order) {

      $order->products = (new Product())->getProducts((array)json_decode($order->products));

      $orders[] = $order;
    }
    return $orders;
  }
}