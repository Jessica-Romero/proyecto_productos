<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistryPriceAlertsProduct $registryPriceAlertsProduct
 */
?>

<?php
$this->assign('title', __('Registry Price Alerts Product'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Registry Price Alerts Products', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($registryPriceAlertsProduct->id) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Registry Price Alert') ?></th>
            <td><?= $registryPriceAlertsProduct->has('registry_price_alert') ? $this->Html->link($registryPriceAlertsProduct->registry_price_alert->id, ['controller' => 'RegistryPriceAlerts', 'action' => 'view', $registryPriceAlertsProduct->registry_price_alert->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Product') ?></th>
            <td><?= $registryPriceAlertsProduct->has('product') ? $this->Html->link($registryPriceAlertsProduct->product->name, ['controller' => 'Products', 'action' => 'view', $registryPriceAlertsProduct->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Competitor Name') ?></th>
            <td><?= h($registryPriceAlertsProduct->competitor_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($registryPriceAlertsProduct->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Price') ?></th>
            <td><?= $this->Number->format($registryPriceAlertsProduct->price) ?></td>
        </tr>
        <tr>
            <th><?= __('Competitor Price') ?></th>
            <td><?= $this->Number->format($registryPriceAlertsProduct->competitor_price) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $registryPriceAlertsProduct->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $registryPriceAlertsProduct->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $registryPriceAlertsProduct->id], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>
</div>


