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

  public function remove(int $id): int
  {
    $tableName = $this->getTableName();
    $sql = "DELETE FROM {$tableName} WHERE id = :id";

    return $this->db->execute($sql, [':id' => $id]);
  }

  public function create(object $object): int
  {
    foreach ($this->getRequiredFields() as $field){
      if(!isset($object->$field)){
        echo "Поле $field обязательно для заполнения";
        exit;
      }
    }

    $sql = $this->getSqlInsert();
    $params = $this->getParams($object);
    array_shift($params);

    return $this->db->execute($sql, $params);
  }

  public function change(object $object): int
  {
    $object = (object)array_merge((array)$this->getOne($object->id), (array)$object);

    $sql = $this->getSqlUpdate();

    return $this->db->execute($sql, $this->getParams($object));
  }
}