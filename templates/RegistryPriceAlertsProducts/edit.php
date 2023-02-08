<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistryPriceAlertsProduct $registryPriceAlertsProduct
 */
?>
<?php
$this->assign('title', __('Edit Registry Price Alerts Product'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Registry Price Alerts Products', 'url' => ['action' => 'index']],
    ['title' => 'View', 'url' => ['action' => 'view', $registryPriceAlertsProduct->id]],
    ['title' => 'Edit'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($registryPriceAlertsProduct) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('registry_price_alert_id', ['options' => $registryPriceAlerts]);
      echo $this->Form->control('product_id', ['options' => $products]);
      echo $this->Form->control('price');
      echo $this->Form->control('competitor_price');
      echo $this->Form->control('competitor_name');
    ?>
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
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

