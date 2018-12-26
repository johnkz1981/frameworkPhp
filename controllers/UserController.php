<?php
namespace app\controllers;

use app\models\repositories\UserRepository;
use app\models\User;
use app\services\Request;
use app\base\App;

class UserController extends Controller
{
  public function actionIndex()
  {
    $user = (new UserRepository())->getAll();
    echo $this->render('user', ['user' => $user]);
  }

  public function actionAuth()
  {
    $request = App::call()->request;

    if ($request->isGet()) {
      $user = $request->getParams('user');
      $password = $request->getParams('password');

      (new User())->auth($user, $password);

    }
  }

  public function actionExit()
  {
    App::call()->auth->exit();
  }
}