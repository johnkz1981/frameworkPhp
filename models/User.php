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

  public function getSqlInsert(): string
  {
    $tableName = $this->getTableName();
    return "INSERT INTO {$tableName} (`user`, password) VALUES (:user, :password)";
  }

  public function getSqlUpdate(): string
  {
    $tableName = $this->getTableName();
    return "UPDATE {$tableName} SET user = :user, password = :password WHERE id = :id";
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
