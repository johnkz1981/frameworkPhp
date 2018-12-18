<?php

namespace app\controllers;

use app\models\Product;
use app\models\repositories\ProductRepository;
use app\services\Request;

class ProductController extends Controller
{

  public function actionIndex()
  {
    echo 'Этот каталог';
  }

  public function actionCard()
  {
    $id = (new Request())->getParams('id');
    $product = (new ProductRepository())->getOne($id);
    echo $this->render('card', ['product' => $product]);
  }
}