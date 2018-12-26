<?php

namespace app\models\repositories;

use app\models\User;

class UserRepository extends Repository
{
  public function getTableName(): string
  {
    return 'users';
  }

  public function getEntityClass(): string
  {
    return User::class;
  }

  public function getPassword(string $user): ?string
  {
    return $this->find("SELECT password FROM users WHERE `user` = \"$user\"")[0]->password;
  }

  public function getId(string $user): ?int
  {
    return $this->find("SELECT id FROM users WHERE `user` = \"$user\"")[0]->id;
  }

  public function isAdmin(string $id): ?int
  {
    return $this->find("SELECT admin FROM users WHERE id = {$id}")[0]->admin;
  }
}