<?php

namespace app\models;

use app\interfaces\IModel;
use app\services\Db;

abstract class Model implements IModel
{
  protected $db;

  public function __construct()
  {
    $this->db = Db::getInstance();
  }

  public static function getOne(int $id): Model
  {
    $tableName = static::getTableName();
    $sql = "SELECT * FROM {$tableName} WHERE id = :id";

    return DB::getInstance()->queryObject($sql, [':id' => $id], get_called_class());
  }

  public static function getAll(): array
  {
    $tableName = static::getTableName();
    $sql = "SELECT * FROM {$tableName}";

    return DB::getInstance()->queryAll($sql);
  }

  public function delete(): int
  {
    $tableName = $this->getTableName();
    $sql = "DELETE FROM {$tableName} WHERE id = :id";

    return $this->db->execute($sql, [':id' => $this->id]);
  }

  public function insert(): int
  {
    $params = [];
    $columns = [];

    foreach ($this as $key => $value) {
      if ($key === 'db') {
        continue;
      }
      $params[":{$key}"] = $value;
      $columns[] = "`$key`";
    }

    $columns = implode(',', $columns);
    $placeholders = implode(',', array_keys($params));

    $tableName = $this->getTableName();
    $sql = "INSERT INTO {$tableName} ($columns) VALUES ({$placeholders})";
    return $this->db->execute($sql, $params);
  }

  public function update(): int
  {
    $params = [];

    foreach ($this as $key => $value) {
      if ($key === 'db') {
        continue;
      }
      $sqlParams["`$key` = :{$key}"] = $value;
      $params[":{$key}"] = $value;
    }

    // $columns = implode(',', $columns);
    $placeholders = implode(',', array_keys($sqlParams));
    var_dump($params);
    $tableName = $this->getTableName();
    $sql = "UPDATE {$tableName} SET {$placeholders} WHERE id = :id";
    var_dump($sql);
    return $this->db->execute($sql, $params);
  }

  public function save(){

  }
}