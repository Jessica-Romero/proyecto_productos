<div class="user-panel mt-3 pb-3 mb-3 d-flex">
  <div class="image">
       <?= $this->Html->image('/img/users/'.$this->Identity->get('img'), ['class'=>'img-circle elevation-2', 'alt'=>'User Image']) ?>
  </div>
  <div class="info">
        <a href="#" class="d-block"><?= $this->Identity->get('name') ?></a>
  </div>
</div>