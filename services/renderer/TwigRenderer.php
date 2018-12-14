<?php

namespace app\services\renderer;

class TwigRenderer implements IRenderer
{
  public function render($template, $params = [])
  {
    $template = $template . '.html';
    $cachePath = TEMPLATES_DIR . 'compilation_cache';

    $loader = new \Twig_Loader_Filesystem(TEMPLATES_DIR);
    $twig = new \Twig_Environment($loader, array(
      'cache' => $cachePath,
    ));

    $name = $params['product']->name;

    return $twig->render($template, ['name' => 'jhgjh']);

  }
}