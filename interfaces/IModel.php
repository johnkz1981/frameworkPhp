<?php

namespace app\interfaces;

interface IModel
{
  public function getOne(int $id): object;

  public function getAll(): array;

  public function getTableName(): string;

  public function remove(int $id): int;

  public function change(object $object): int;

  public function create(object $object): int;

  public function getSqlInsert(): string;

  public function getSqlUpdate(): string;

  public function getParams(object $object): array;

  public function getRequiredFields(): array;
}