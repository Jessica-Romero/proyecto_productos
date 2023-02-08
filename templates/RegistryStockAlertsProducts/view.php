<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistryStockAlertsProduct $registryStockAlertsProduct
 */
?>

<?php
$this->assign('title', __('Registry Stock Alerts Product'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Registry Stock Alerts Products', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($registryStockAlertsProduct->id) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Registry Stock Alert') ?></th>
            <td><?= $registryStockAlertsProduct->has('registry_stock_alert') ? $this->Html->link($registryStockAlertsProduct->registry_stock_alert->id, ['controller' => 'RegistryStockAlerts', 'action' => 'view', $registryStockAlertsProduct->registry_stock_alert->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Product') ?></th>
            <td><?= $registryStockAlertsProduct->has('product') ? $this->Html->link($registryStockAlertsProduct->product->name, ['controller' => 'Products', 'action' => 'view', $registryStockAlertsProduct->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($registryStockAlertsProduct->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Available Stock') ?></th>
            <td><?= $this->Number->format($registryStockAlertsProduct->available_stock) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $registryStockAlertsProduct->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $registryStockAlertsProduct->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $registryStockAlertsProduct->id], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>
</div>


