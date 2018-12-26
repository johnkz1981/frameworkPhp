<?php

namespace app\services;

class Request
{
  protected $requestString;
  protected $controllerName;
  protected $actionName;
  protected $params;
  protected $requestMethod;

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

  public function getAllParams()
  {
    return $this->params;
  }

  public function isAjax()
  {
    return $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
  }

  public function isGet()
  {
    return $_SERVER['REQUEST_METHOD'] === 'GET';
  }

  public function isPost()
  {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
  }
}