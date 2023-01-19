<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductStock $productStock
 */
?>

<?php
$this->assign('title', __('Product Stock'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Product Stock', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($productStock->id) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Product') ?></th>
            <td><?= $productStock->has('product') ? $this->Html->link($productStock->product->name, ['controller' => 'Products', 'action' => 'view', $productStock->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Shop') ?></th>
            <td><?= $productStock->has('shop') ? $this->Html->link($productStock->shop->name, ['controller' => 'Shops', 'action' => 'view', $productStock->shop->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Rating') ?></th>
            <td><?= h($productStock->rating) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($productStock->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Stock Level') ?></th>
            <td><?= $this->Number->format($productStock->stock_level) ?></td>
        </tr>
        <tr>
            <th><?= __('Sales Last Days') ?></th>
            <td><?= $this->Number->format($productStock->sales_last_days) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($productStock->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($productStock->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('In Stock') ?></th>
            <td><?= $productStock->in_stock ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $productStock->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $productStock->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $productStock->id], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>
</div>


