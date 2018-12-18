<?php
namespace app\models\repositories;
use app\interfaces\IRepository;
use app\services\Db;
use app\models\Records;

abstract class Repository implements IRepository
{
  protected $db;

  public function __construct()
  {
    $this->db = static::getDb();
  }

  public static function getDb()
  {
    return Db::getInstance();
  }

  public function getOne(int $id)
  {
    $tableName = $this->getTableName();
    $sql = "SELECT * FROM {$tableName} WHERE id = :id";

    return static::getDb()->queryObject($sql, [':id' => $id], $this->getEntityClass());
  }

  public function getAll(): array
  {
    $tableName = $this->getTableName();
    $sql = "SELECT * FROM {$tableName}";

    return static::getDb()->queryAll($sql);
  }

  public function delete(Records $records): int
  {
    $tableName = $this->getTableName();
    $sql = "DELETE FROM {$tableName} WHERE id = :id";

    return $this->db->execute($sql, [':id' => $records->id]);
  }

  public function insert(Records $records): int
  {
    $params = [];
    $columns = [];

    foreach ($records as $key => $value) {
      if ($key === 'db' ) {
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

  public function update(Records $records): int
  {
    $params = [];

    foreach ($records as $key => $value) {
      if ($key === 'db') {
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

  public function save(Records $records): int
  {
    if (is_null($records->id)) {
      return $this->insert($records);
    } else {
      return $this->update($records);
    }
  }
}