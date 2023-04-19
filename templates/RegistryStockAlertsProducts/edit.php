<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistryStockAlertsProduct $registryStockAlertsProduct
 */
?>
<?php
$this->assign('title', __('Edit Registry Stock Alerts Product'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Registry Stock Alerts Products', 'url' => ['action' => 'index']],
    ['title' => 'View', 'url' => ['action' => 'view', $registryStockAlertsProduct->id]],
    ['title' => 'Edit'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($registryStockAlertsProduct) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('registry_stock_alert_id', ['options' => $registryStockAlerts]);
      echo $this->Form->control('product_id', ['options' => $products]);
      echo $this->Form->control('available_stock');
    ?>
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
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

