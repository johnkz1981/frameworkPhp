<?php

namespace app\models;

class User extends Model
{
  public $id;
  public $user;
  public $password;

  public function getTableName(): string
  {
    return 'users';
  }
}
