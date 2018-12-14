<?php
// namespace app;

use app\models\Product;
use app\models\Records;
use app\models\User;

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include ROOT_DIR . "/services/Autoloader.php";
include ROOT_DIR . "/vendor/autoload.php";

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

//$product = Product::getOne(14);
/*$product = new Product();
$product->id = 8;
$product->name = 'Лютик55';
$product->price = '25000';
$product->description = 'update';
$product->category_id = 1;
$product->producer_id = 1;

echo $product->save();*/

$controllerName = $_GET['c'] ?: DEFAULT_CONTROLLER;
$actionName = $_GET['a'];

$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . 'Controller';

if(class_exists($controllerClass)){
  /** @var \app\controllers\ProductControllers $controller */
  $controller = new $controllerClass(
    new app\services\renderer\TwigRenderer()
  );
  $controller->runAction($actionName);
}




