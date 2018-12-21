<?php

namespace app\controllers;

use app\base\App;
use app\models\Product;
use app\models\repositories\ProductRepository;
use app\services\Request;
use app\services\renderer\IRenderer;

class ProductController extends Controller
{
  public function actionIndex()
  {
    echo 'Этот каталог';
  }

  public function actionCard()
  {
    $id = App::call()->request->getParams('id');
    $product = (new ProductRepository())->getOne($id);
    echo $this->render('card', ['product' => $product]);
  }
}