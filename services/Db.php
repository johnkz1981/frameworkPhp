<?php

namespace app\services;

use app\traits\TSingletone;

class Db
{
  use TSingletone;

  private $config;

  /** @var \PDO */
  private $conn = null;

  public function __construct($driver, $host, $login, $password, $database, $port, $charset)
  {
    $this->config = [
      'driver' => $driver,
      'host' => $host,
      'login' => $login,
      'password' => $password,
      'database' => $database,
      'port' => $port,
      'charset' => $charset
    ];
  }


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
    return $this->query($sql, $params)->fetchObject()[0];
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
    return $smtp->fetchAll();
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