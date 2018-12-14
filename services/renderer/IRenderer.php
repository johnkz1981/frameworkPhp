<?php
namespace app\services\renderer;

interface IRenderer
{
  public function render($template, $params = []);

}