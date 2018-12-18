<?php
// namespace app;

use app\models\Product;
use app\models\Records;
use app\models\User;

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
$loader = include ROOT_DIR . "/vendor/autoload.php";

$request = new \app\services\Request();

//$product = Product::getOne(14);
/*$product = new Product();
$product->id = 8;
$product->name = 'Лютик55';
$product->price = '25000';
$product->description = 'update';
$product->category_id = 1;
$product->producer_id = 1;

echo $product->save();*/

$controllerName = $request->getControllerName() ?: DEFAULT_CONTROLLER;
$actionName = $request->getActionName();

$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . 'Controller';

if(class_exists($controllerClass)){
  /** @var \app\controllers\ProductControllers $controller */
  $controller = new $controllerClass(
    new app\services\renderer\TemplateRenderer()
  );
  $controller->runAction($actionName);
}




