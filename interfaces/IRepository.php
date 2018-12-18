<?php

namespace app\interfaces;

use app\models\Records;

interface IRepository
{
  public function getOne(int $id);

  public function getAll(): array;

  public function getTableName(): string;

  public function getEntityClass(): string;

  public function update(Records $records): int;

  public function insert(Records $records): int;

  public function delete(Records $records): int;

  public function save(Records $records): int;
}