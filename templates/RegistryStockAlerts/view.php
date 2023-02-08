<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistryStockAlert $registryStockAlert
 */
?>

<?php
$this->assign('title', __('Registry Stock Alert'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Registry Stock Alerts', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($registryStockAlert->id) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Stockalert') ?></th>
            <td><?= $registryStockAlert->has('stockalert') ? $this->Html->link($registryStockAlert->stockalert->id, ['controller' => 'StockAlerts', 'action' => 'view', $registryStockAlert->stockalert->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($registryStockAlert->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($registryStockAlert->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($registryStockAlert->modified) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $registryStockAlert->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $registryStockAlert->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $registryStockAlert->id], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-products view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Products') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('New'), ['controller' => 'Products' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('List '), ['controller' => 'Products' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id') ?></th>
          <th><?= __('Name') ?></th>
          <th><?= __('Sku') ?></th>
          <th><?= __('Brand Id') ?></th>
          <th><?= __('Image') ?></th>
          <th><?= __('Created') ?></th>
          <th><?= __('Modified') ?></th>
          <th class="actions"><?= __('Actions') ?></th>
      </tr>
      <?php if (empty($registryStockAlert->products)) { ?>
        <tr>
            <td colspan="8" class="text-muted">
              Products record not found!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($registryStockAlert->products as $products) : ?>
        <tr>
            <td><?= h($products->id) ?></td>
            <td><?= h($products->name) ?></td>
            <td><?= h($products->sku) ?></td>
            <td><?= h($products->brand_id) ?></td>
            <td><?= h($products->image) ?></td>
            <td><?= h($products->created) ?></td>
            <td><?= h($products->modified) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $products->id)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>

