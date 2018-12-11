<?php

namespace app\controllers;

use app\models\Product;

class ProductControllers
{
  protected $action = null;
  protected $defaultAction = 'index';
  protected $useLayout = true;
  protected $layout = 'main';

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

  public function actionIndex()
  {
    echo 'Этот каталог';
  }

  public function actionCard()
  {
    $this->useLayout = true;
    $id = $_GET['id'];
    $product = Product::getOne($id);
    echo $this->render('card', ['product' => $product]);
  }

  protected function render($template, $params){

    if($this->useLayout){
      return $this->renderTemplate("layouts/{$this->layout}",
        ['content' => $this->renderTemplate($template, $params)]);
    }
    return $this->renderTemplate($template, $params);
  }

  protected function renderTemplate($template, $params)
  {
    ob_start();
    extract($params);
    $templatePath = TEMPLATES_DIR . $template . '.php';
    include $templatePath;
    return ob_get_clean();
  }
}