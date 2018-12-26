<?php

namespace app\services;

use app\models\repositories\UserRepository;
use app\base\App;

class Auth
{
  public function authorize($user, $password)
  {
    $comparePassword = (new UserRepository)->getPassword($user);

    if ($password === $comparePassword) {

      App::call()->session->set('auth', true);
      App::call()->session->set('user_id', (new UserRepository)->getId($user));
    } else {
      App::call()->session->set('auth', false);
    }
  }

  public function isAuth()
  {
    return App::call()->session->get('auth');
  }

  public function exit()
  {
    App::call()->session->set('auth', false);
    App::call()->session->set('user_id', 0);
  }

  public function getId()
  {
    return App::call()->session->get('user_id');
  }

  public function isAdmin()
  {
    return (new UserRepository())->isAdmin($this->getId());
  }

}