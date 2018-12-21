<?php
namespace app\controllers;

use app\models\Basket;
use app\base\App;
use app\services\Auth;
use app\services\Request;

class BasketController extends Controller
{
  public function actionIndex()
  {
    echo $this->render('cart', ['basket' => (new Basket())->getAll()], false);
  }

  public function actionAdd()
  {
    $request = new Request();

    if ($request->isPost()) {
      $productId = (int)$request->getParams('id');
      $productQty = (int)$request->getParams('qty') ?: 1;

      (new Basket())->add($productId, $productQty);

      echo json_encode(
        ['success' => 'ok',
          'message' => 'Товар был успешно добавлен',
          'session' => $session = App::call()->session->getAllOfDirectory('basket')
        ]
      );
    }
  }

  public function actionRemove()
  {
    $request = new Request();

    if ($request->isGet()) {
      $productId = (int)$request->getParams('id');

      (new Basket())->remove($productId);

      echo 'Товар был успешно удален';
    }
  }
}