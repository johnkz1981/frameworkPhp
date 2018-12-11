<?php
namespace app;

use app\models\Product;
use app\models\Records;
use app\models\User;

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include ROOT_DIR . "/services/Autoloader.php";

spl_autoload_register([new services\Autoloader(), 'loadClass']);

/* $product = Product::getOne(10);


$product->name = 'Лютик55';
$product->update();*/

$controllerName = $_GET['c'] ?? DEFAULT_CONTROLLER;
$actionName = $_GET['a'];

$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . 'Controllers';

if(class_exists($controllerClass)){
  /** @var \app\controllers\ProductControllers $controller */
  $controller = new $controllerClass;
  $controller->runAction($actionName);
}




