<?php

namespace app\controllers;

use app\models\Product;

class ProductController extends Controller
{

  public function actionIndex()
  {
    echo 'Этот каталог';
  }

  public function actionCard()
  {
    $this->useLayout = true;
    $id = $_GET['id'];
    $product = Product::getOne($id);
    echo $this->render('card', ['product' => $product]);
  }
}