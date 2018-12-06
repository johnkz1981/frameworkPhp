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

  public function getOne(int $id): object
  {
    $tableName = $this->getTableName();
    $sql = "SELECT * FROM {$tableName} WHERE id = :id";

    return $this->db->queryOne($sql, [':id' => $id]);
  }

  public function getAll(): array
  {
    $tableName = $this->getTableName();
    $sql = "SELECT * FROM {$tableName}";

    return $this->db->queryAll($sql);
  }

  abstract public function getTableName(): string;
}