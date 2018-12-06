<?php
namespace app;

use app\models\Product;
use app\models\User;

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include ROOT_DIR . "/services/Autoloader.php";

spl_autoload_register([new services\Autoloader(), 'loadClass']);

$product = new Product();
// $product->remove(1);

$obj = new \stdClass();

$obj->name = 'Красная роза';
$obj->id = 6;
$obj->price = 155;

// $product->change($obj);
// echo $product->create($obj);

$user = new User();

$obj->user = 'john';
$obj->password = '123';

$user->create($obj);