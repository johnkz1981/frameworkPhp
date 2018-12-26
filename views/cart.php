<h3>Товары в козине</h3>
<?php if (empty($basket)): ?>
  <div>Козина пуста!</div>
<?php else: ?>
  <form action="/order/add" method="post">
    <?php foreach ($basket as $item): ?>
      <div>
        <?= $item['product']->name ?>:<?= $item['count'] ?>
        <a href="/basket/remove?id=<?= $item['product']->id ?>">Удалить</a>
      </div>
    <?php endforeach ?>
    <textarea name="address" id="" cols="30" rows="10" placeholder="Введите адрес"></textarea>
    <input type="text" name="phone" placeholder="Введите телефон">
    <input type="submit" value="добавить в заказ">
  </form>
<?php endif ?>
<script>

</script>