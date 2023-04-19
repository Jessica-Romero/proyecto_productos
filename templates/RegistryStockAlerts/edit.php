<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistryStockAlert $registryStockAlert
 */
?>
<?php
$this->assign('title', __('Edit Registry Stock Alert'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Registry Stock Alerts', 'url' => ['action' => 'index']],
    ['title' => 'View', 'url' => ['action' => 'view', $registryStockAlert->id]],
    ['title' => 'Edit'],
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
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $registryStockAlert->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $registryStockAlert->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

