<?php

namespace app\controllers;

use app\base\App;
use app\models\Order;
use app\models\User;

class OrderController extends Controller
{
  public function actionIndex()
  {
    echo $this->render('order', [
      'orders' => (new Order())->getOrders(),
      'users' => (new User())->getUsers(),
      'admin' => App::call()->auth->isAdmin()
    ], false);
  }

  public function actionAdd()
  {
    $request = App::call()->request;
    $session = App::call()->session;
    $auth = App::call()->auth;
    $validator = App::call()->validator;

    $basket = $session->getAllOfDirectory('basket');
    $address = $request->getParams('address');
    $phone = $request->getParams('phone');
    $user_id = $auth->getId();
    $arrValid = [
      [
        'key' => 'basket',
        'value' => $basket,
        'check' => 'require'
      ],
      [
        'key' => 'address',
        'value' => $address,
        'check' => 'require'
      ],
      [
        'key' => 'phone',
        'value' => $phone,
        'check' => 'require'
      ],
    ];

    if($validator->getCheck($arrValid)) {
      (new Order())->add($basket, $address, $phone, $user_id);
    } else {
      echo $validator->viewMessages($arrValid);
    }
  }
}