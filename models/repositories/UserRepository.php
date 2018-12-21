<?php

namespace app\models\repositories;

use app\models\User;

class UserRepository extends Repository
{
  public function getTableName(): string
  {
    return 'users';
  }

  public function getEntityClass(): string
  {
    return User::class;
  }

  public function getPassword(string $user)
  {
    return $this->find("SELECT * FROM users WHERE `user` = \"$user\"");
  }
}