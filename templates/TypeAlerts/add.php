<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TypeAlert $typeAlert
 */
?>
<?php
$this->assign('title', __('Add Type Alert'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Type Alerts', 'url' => ['action' => 'index']],
    ['title' => 'Add'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($typeAlert) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('name');
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

