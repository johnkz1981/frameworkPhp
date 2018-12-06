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

  public function remove(int $id): int
  {
    $tableName = $this->getTableName();
    $sql = "DELETE FROM {$tableName} WHERE id = :id";

    return $this->db->execute($sql, [':id' => $id]);
  }

  public function change(object $object): int
  {
    $object = (object)array_merge((array)$this->getOne($object->id), (array)$object);

    $tableName = $this->getTableName();
    $sql = "UPDATE {$tableName} SET user = :user, password = :password WHERE id = :id";

    return $this->db->execute($sql, [
      ':id' => $object->id,
      ':name' => $object->user,
      ':description' => $object->password,
    ]);
  }

  public function create(object $object): int
  {
    if(!isset($object->user) || !isset($object->password)) {
      echo 'Поля user и password обязательны!';
      exit;
    }

    $tableName = $this->getTableName();
    $sql = "INSERT INTO {$tableName} (user, password)";
    $sql .= " VALUES (:user, :password)";

    return $this->db->execute($sql, [
      ':user' => $object->user,
      ':password' => $object->password,
    ]);
  }
}
