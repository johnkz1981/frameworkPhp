<?php
namespace app;

use app\models\Product;
use app\models\User;

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include ROOT_DIR . "/services/Autoloader.php";

spl_autoload_register([new services\Autoloader(), 'loadClass']);

 $product = new Product();
// $user = new User();
$obj = new \stdClass();

// $obj->id = 6;
$obj->name = 'Анютины глазки';
$obj->price = 455;

// $product->remove($obj->id);
// $product->change($obj);
// $product->create($obj);

$obj->id = 6;
$obj->user = 'Vas';
// $obj->password = '4566';

 echo $product->create($obj);

// echo $product->change($obj);