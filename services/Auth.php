<?php

namespace app\services;

use app\models\repositories\UserRepository;

class Auth
{
  public function authorize($user, $password)
  {
    $comparePassword = (new UserRepository)->getPassword($user);
    return $password === $comparePassword;
  }
}