<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductStock $productStock
 */
?>
<?php
$this->assign('title', __('Add Product Stock'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Product Stock', 'url' => ['action' => 'index']],
    ['title' => 'Add'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($productStock) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('product_id', ['options' => $products]);
      echo $this->Form->control('shop_id', ['options' => $shops]);
      echo $this->Form->control('in_stock', ['custom' => true]);
      echo $this->Form->control('stock_level');
      echo $this->Form->control('sales_last_days');
      echo $this->Form->control('rating');
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

