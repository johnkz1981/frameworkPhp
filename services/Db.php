<?php

namespace app\services;

use app\traits\TSingletone;

class Db
{
  use TSingletone;

  private $config = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'login' => 'root',
    'password' => 'Cnj1124763!@',
    'database' => 'framework',
    'port' => 3306,
    'charset' => 'utf8'
  ];

  /** @var \PDO */
  private $conn = null;

  function getConnection()
  {
    if (is_null($this->conn)) {
      $this->conn = new \PDO(
        $this->prepareDsnString(),
        $this->config['login'],
        $this->config['password']
      );

      $this->conn->setAttribute(
        \PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC
      );
    }
    return $this->conn;
  }

  private function query($sql, $params = [])
  {
    $pdoStatement = $this->getConnection()->prepare($sql);
    $pdoStatement->execute($params);
    return $pdoStatement;
  }

  public function execute($sql, $params = [])
  {
    var_dump($params);
    var_dump($sql);

    $pdoStatement = $this->query($sql, $params);
    return $pdoStatement->rowCount();
  }

  public function queryOne($sql, $params = [])
  {
    return $this->query($sql, $params)->fetchObject();
  }

  public function queryAll($sql, $params = [])
  {
    $arrObj = [];
    $pdoStatement = $this->query($sql, $params);

    while ($result = $pdoStatement->fetchObject()) {

      $arrObj[] = $result;
    }
    return $arrObj;
  }

  public function queryObject($sql, $params = [], $class)
  {
    $smtp = $this->query($sql, $params);
    $smtp->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
    return $smtp->fetch();
  }

  private function prepareDsnString()
  {
    return sprintf("%s:host=%s;dbname=%s;charset=%s",
      $this->config['driver'],
      $this->config['host'],
      $this->config['database'],
      $this->config['charset']
    );
  }
}