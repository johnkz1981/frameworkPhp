<?php

namespace app\interfaces;

use app\models\Model;

interface IModel
{
  public static function getOne(int $id): Model;

  public static function getAll(): array;

  public static function getTableName(): string;

  public function delete(): int;

  public function update(): int;

  public function insert(): int;
}