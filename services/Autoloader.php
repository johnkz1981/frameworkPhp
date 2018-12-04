<?php

namespace app\services;

class Autoloader
{
  public function loadClass($className)
  {
    $className = str_replace('app', '', $className);
    $filename = ROOT_DIR . "{$className}.php";
    include_once($filename);
  }
}