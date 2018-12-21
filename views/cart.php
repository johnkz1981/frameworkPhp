<h3>Товары в козине</h3>
<?php if (empty($basket)): ?>
  <div>Козина пуста!</div>
<?php else: ?>
  <?php foreach ($basket as $item): ?>
    <div>
      <?= $item['product']->name ?>:<?= $item['count'] ?>
      <a href="/basket/remove?id=<?=$item['product']->id?>">Удалить</a>
    </div>
  <?php endforeach ?>
<?php endif ?>
<script>

</script>