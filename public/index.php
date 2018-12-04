<?php
namespace app;

include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include ROOT_DIR . "/services/Autoloader.php";

spl_autoload_register([new services\Autoloader(), 'loadClass']);

new services\Db();
$product = new \app\models\Product();

$product->name = 'Роза';
var_dump($product);

