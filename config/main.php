<?php

return [
  'rootDir' => __DIR__ . '/../',
  'templatesDir' => __DIR__ . '/../views/',
  'defaultController' => 'product',
  'controllersNamespace' => 'app\\controllers\\',
  'components' => [
    'db' => [
      'class' => \app\services\Db::class,
      'driver' => 'mysql',
      'host' => 'localhost',
      'login' => 'root',
      'password' => '',
      'database' => 'rose',
      'port' => 3306,
      'charset' => 'utf8'
    ],
    'request' => [
      'class' => \app\services\Request::class
    ],
    'renderer' => [
      'class' => \app\services\renderer\TemplateRenderer::class
    ],
    'session' => [
      'class' => \app\services\Session::class
    ],
    'auth' => [
      'class' => \app\services\Auth::class
    ],
    'validator' => [
      'class' => \app\services\Validator::class
    ]
  ]
];