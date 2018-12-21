<?php

namespace app\services;

class Session
{
  public function __construct()
  {
    session_start();
  }

  public function get($key)
  {
    return $_SESSION[$this->getId()][$key[0]][$key[1]];
  }

  public function set($key, $value)
  {
    $_SESSION[$this->getId()][$key[0]][$key[1]] = $value;
  }

  public function unSet($key)
  {
    unset($_SESSION[$this->getId()][$key[0]][$key[1]]);
  }

  public function getAllCurrentId()
  {
    return $_SESSION[$this->getId()];
  }

  public function getAllOfDirectory($key)
  {
    return $_SESSION[$this->getId()][$key];
  }

  public function getAll()
  {
    return $_SESSION;
  }

  public function getId()
  {
    return session_id();
  }
}