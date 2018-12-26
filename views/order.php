<h3>Заказы</h3>
<?php if (!$admin): ?>
  <div>Вы не администратор!</div>
<?php else: ?>
  <?php if (empty($orders)): ?>
    <div>Заказов нет!</div>
  <?php else: ?>
    <?php foreach ($orders as $order): ?>
      <div>
        <?= $users[$order->user_id]->user ?>
        <?php foreach ($order->products as $product): ?>
          <tr>
            <td><?= $product->name ?></td>
            <td><?= $product->count ?></td>
          </tr>
        <?php endforeach ?>
        <a href="/user/remove?id=<?= $order->id ?>">Удалить</a>
      </div>
    <?php endforeach ?>
  <?php endif ?>
<?php endif ?>