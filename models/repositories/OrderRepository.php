<?php

namespace app\models\repositories;

use app\models\Order;

class OrderRepository extends Repository
{
  public function getTableName(): string
  {
    return 'orders';
  }

  public function getEntityClass(): string
  {
    return Order::class;
  }

  public function getPassword(string $user): ?string
  {
    return $this->find("SELECT password FROM users WHERE `user` = \"$user\"")[0]->password;
  }
}