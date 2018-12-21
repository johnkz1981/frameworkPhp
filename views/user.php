<h3>Пользователи</h3>
<?php if (empty($user)): ?>
  <div>Пользователей нет!</div>
<?php else: ?>
  <?php foreach ($user as $item): ?>
    <div>
      <?= $item->user ?>
      <a href="/user/remove?id=<?=$item->id?>">Удалить</a>
    </div>
  <?php endforeach ?>
<?php endif ?>