<?php

namespace app\models;

use app\interfaces\IRecords;
use app\services\Db;

abstract class Records implements IRecords
{
  protected $db;
  public $state = null;

  public function __construct()
  {
    $this->db = Db::getInstance();
  }

  public static function getOne(int $id): Records
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

  protected function insert(): int
  {
    $params = [];
    $columns = [];

    foreach ($this as $key => $value) {
      if ($key === 'db' || $key === 'state') {
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

  protected function update(): int
  {
    $params = [];

    foreach ($this as $key => $value) {
      if ($key === 'db' || $key === 'state') {
        continue;
      }
      $sqlParams["`$key` = :{$key}"] = $value;
      $params[":{$key}"] = $value;
    }

    // $columns = implode(',', $columns);
    $placeholders = implode(',', array_keys($sqlParams));

    $tableName = $this->getTableName();
    $sql = "UPDATE {$tableName} SET {$placeholders} WHERE id = :id";

    return $this->db->execute($sql, $params);
  }

  public function save(): int
  {
    if ($this->state === 'update') {
      return $this->update();
    } elseif ($this->state === 'insert') {
      return $this->insert();
    }
  }
}