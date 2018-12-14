<?php

namespace app\controllers;

use app\services\renderer\IRenderer;

abstract class Controller
{
  protected $action = null;
  protected $defaultAction = 'index';
  protected $useLayout = true;
  protected $layout = 'main';

  protected $renderer;

  public function __construct(IRenderer $renderer)
  {
    $this->renderer = $renderer;
  }

  public function runAction($action = null)
  {
    $this->action = $action ?: $this->defaultAction;
    $method = 'action' . ucfirst($this->action);

    if (method_exists($this, $method)) {
      $this->$method();
    } else {
      echo 404;
    }
  }

  protected function render($template, $params)
  {
    if ($this->useLayout) {
      return $this->renderTemplate("layouts/{$this->layout}",
        ['content' => $this->renderTemplate($template, $params)]);
    }
    return $this->renderTemplate($template, $params);
  }

  protected function renderTemplate($template, $params)
  {
    return $this->renderer->render($template, $params);
  }
}