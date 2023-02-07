<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductPrice $productPrice
 */
?>

<?php
$this->assign('title', __('Product Price'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Product Prices', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($productPrice->id) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Product') ?></th>
            <td><?= $productPrice->has('product') ? $this->Html->link($productPrice->product->name, ['controller' => 'Products', 'action' => 'view', $productPrice->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Shop') ?></th>
            <td><?= $productPrice->has('shop') ? $this->Html->link($productPrice->shop->name, ['controller' => 'Shops', 'action' => 'view', $productPrice->shop->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($productPrice->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Cost') ?></th>
            <td><?= $this->Number->format($productPrice->cost) ?></td>
        </tr>
        <tr>
            <th><?= __('Price') ?></th>
            <td><?= $this->Number->format($productPrice->price) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $productPrice->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $productPrice->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $productPrice->id], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>
</div>


