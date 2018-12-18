<?php

namespace app\services;

class Request
{
  protected $requestString;
  protected $controllerName;
  protected $actionName;
  protected $params;

  public function __construct()
  {
    $this->requestString = $_SERVER['REQUEST_URI'];
    $this->parseRequest();
  }

  private function parseRequest()
  {
    $pattern = '#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)?#ui';

    if (preg_match_all($pattern, $this->requestString, $matches)) {
      $this->controllerName = $matches['controller'][0];
      $this->actionName = $matches['action'][0];
      $this->params = $_REQUEST;
    }
  }

  public function getControllerName()
  {
    return $this->controllerName;
  }

  public function getActionName()
  {
    return $this->actionName;
  }

  public function getParams($key)
  {
    return $this->params[$key];
  }

  public function isAjax()
  {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
      return 'Это ajax запрос!';
    }
    return 'Это не ajax запрос!';
  }
}