<?php

namespace app\models;

abstract class Model implements \app\interfaces\IModel
{
  protected $db;

  public function __construct()
  {
    $this->db = new \app\services\Db;
  }

  public function getOne(int $id): array
  {
    $sql = "SELECT * FROM {$this->getTableName()} WHERE id = {$id}";
    return $this->db->queryOne($sql);
  }

  public function getAll(): array
  {
    $sql = "SELECT * FROM {$this->getTableName()}";
    return $this->db->queryAll($sql);
  }

  abstract public function getTableName(): string;
}