<?php /** @var \app\models\entities\Product $product */ ?>

<h1><?= $product->name ?></h1>
<div><?= $product->description ?></div>
<div>
  <input id="qty_input" type="text" name="qty">
  <button data-id="<?= $product->id ?>" id="add_to_card">Добавить в корзину</button>
</div>
<script>

  document.getElementById('add_to_card').addEventListener('click', (event) => {
    const id = event.target.dataset.id;
    const qty = document.getElementById('qty_input').value;
    const url = `/basket/add`;
    const body = `qty=${qty}&id=${id}`;

    fetch(url, {
      method: 'POST',
      body: body,
      headers: {
        'content-Type': 'application/x-www-form-urlencoded'
      }
    })
        .then( response => {
          console.log(response.status);

          return response.json();
        })
        .then(data => {
          console.log(data);
        })
        .catch(err => console.log(err));
  })
</script>

