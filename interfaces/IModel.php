<?php

namespace app\interfaces;

interface IModel
{
  public function getOne(int $id): object ;

  public function getAll(): array;

  public function getTableName(): string;

  public function remove(int $id): int;

  public function change(object $object): int;
}