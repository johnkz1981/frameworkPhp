<?php
namespace app\controllers;

use app\models\repositories\UserRepository;
use app\models\User;
use app\services\Request;

class UserController extends Controller
{
  public function actionIndex()
  {
    $user = (new UserRepository())->getAll();
    echo $this->render('user', ['user' => $user]);
  }

  public function actionAuth()
  {
    $request = new Request();

    if ($request->isGet()) {
      $user = $request->getParams('user');
      $password = $request->getParams('password');

      (new User())->auth($user, $password);

    }
  }
}