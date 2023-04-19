<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistryPriceAlert $registryPriceAlert
 */
?>
<?php
$this->assign('title', __('Edit Registry Price Alert'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Registry Price Alerts', 'url' => ['action' => 'index']],
    ['title' => 'View', 'url' => ['action' => 'view', $registryPriceAlert->id]],
    ['title' => 'Edit'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($registryPriceAlert) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('pricealert_id', ['options' => $pricealerts]);
        echo $this->Form->control('products._ids', ['options' => $products]);
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $registryPriceAlert->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $registryPriceAlert->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

