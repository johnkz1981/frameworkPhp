<?php
namespace app;

use app\models\Product;
use app\models\User;

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include ROOT_DIR . "/services/Autoloader.php";

spl_autoload_register([new services\Autoloader(), 'loadClass']);

 $product = Product::getOne(10);
// $user = new User();

// $obj->password = '4566';

// echo $product->create($obj);

// echo $product->change($obj);
/*$product = new Product();
$product->name = 'Роза';
$product->description = 'Роза Роза';
$product->price = 20;
$product->producer_id = 1;
$product->category_id = 1;

echo $product->insert();*/

$product->name = 'Лютик55';
$product->update();




