<?php

namespace app\services;

class Validator
{
  public function getCheck(array $arr)
  {
    $check = true;

    foreach ($arr as $item) {

      if (!$item['value']) {

        $check = false;
      }
    }
    return $check;
  }

  private function getMessages($criterion)
  {
    return [
      'require' => 'значение не должно быть пустым',
      'admin' => 'доступ только для администратора'
    ][$criterion];
  }

  public function viewMessages(array $arr) {
    $messages = '';

    foreach ($arr as $item) {

      if (!$item['value']) {

        $messages .= "{$this->getMessages($item['check'])} {$item['key']}<br>";
      }
    }
    return $messages;
  }
}