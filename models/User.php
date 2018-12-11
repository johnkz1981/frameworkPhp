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

  public function getParams(object $object): array
  {
    return [
      ':id' => $object->id,
      ':user' => $object->user,
      ':password' => $object->password,
    ];
  }

  public function getRequiredFields(): array
  {
    return [
      'user', 'password'
    ];
  }
}
