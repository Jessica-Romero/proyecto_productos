<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistryStockAlert $registryStockAlert
 */
?>
<?php
$this->assign('title', __('Add Registry Stock Alert'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Registry Stock Alerts', 'url' => ['action' => 'index']],
    ['title' => 'Add'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($registryStockAlert) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('stockalert_id', ['options' => $stockalerts]);
        echo $this->Form->control('products._ids', ['options' => $products]);
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

