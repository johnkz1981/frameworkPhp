<?php

namespace app\interfaces;

use app\models\Records;

interface IRecords
{
  public static function getOne(int $id): Records;

  public static function getAll(): array;

  public static function getTableName(): string;

  public function delete(): int;

  public function update(): int;

  public function insert(): int;
}