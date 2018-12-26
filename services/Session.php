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
    if(is_array($key)){
      return $_SESSION[$this->getId()][$key[0]][$key[1]];
    } else {
      return $_SESSION[$this->getId()][$key];
    }
  }

  public function set($key, $value)
  {
    if(is_array($key)){
      $_SESSION[$this->getId()][$key[0]][$key[1]] = $value;
    } else {
      $_SESSION[$this->getId()][$key] = $value;
    }
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