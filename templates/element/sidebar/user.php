<div class="user-panel mt-3 pb-3 mb-3 d-flex">
  <div class="image">
       <?= $this->Html->image('/img/2.jpg', ['class'=>'img-circle elevation-3', 'alt'=>'User Image']) ?>
  </div>
  <div class="info">
        <a href="#" class="d-block"><?= $this->Identity->get('name') ?></a>
  </div>
</div>
