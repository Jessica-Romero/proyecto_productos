<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockAlert $stockAlert
 */
?>
<?php
$this->assign('title', __('Add Stock Alert'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Stock Alerts', 'url' => ['action' => 'index']],
    ['title' => 'Add'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($stockAlert) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('brand_id', ['options' => $brands]);
      echo $this->Form->control('emails');
      echo $this->Form->control('value');
      echo $this->Form->control('active', ['custom' => true]);
      echo $this->Form->control('type_alert_id', ['options' => $typeAlerts]);
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

