<?php

namespace app\models;

use app\base\App;
use app\models\repositories\UserRepository;

class User extends Records
{
  public $id;
  public $user;
  public $password;

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

  public function auth($user, $password)
  {
    $auth = App::call()->auth;
    $auth->authorize($user, $password);
  }

  public function getUsers(){

    $users = [];

    foreach ((new UserRepository())->getAll() as $user) {

      $users[$user->id] = $user;
    }
    return $users;
  }
}
