<?php

namespace app\services\renderer;

use app\base\App;

class TemplateRenderer implements IRenderer
{
  public function render($template, $params = [])
  {
    ob_start();
    extract($params);
    $templatePath = App::call()->config['templatesDir'] . $template . '.php';
    include $templatePath;
    return ob_get_clean();
  }
}