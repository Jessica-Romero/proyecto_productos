<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistryPriceAlert $registryPriceAlert
 */
?>

<?php
$this->assign('title', __('Registry Price Alert'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Registry Price Alerts', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($registryPriceAlert->id) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Pricealert') ?></th>
            <td><?= $registryPriceAlert->has('pricealert') ? $this->Html->link($registryPriceAlert->pricealert->id, ['controller' => 'PriceAlerts', 'action' => 'view', $registryPriceAlert->pricealert->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($registryPriceAlert->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($registryPriceAlert->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($registryPriceAlert->modified) ?></td>
        </tr>
    </table>
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
      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $registryPriceAlert->id], ['class' => 'btn btn-secondary']) ?>
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
      <?php if (empty($registryPriceAlert->products)) { ?>
        <tr>
            <td colspan="8" class="text-muted">
              Products record not found!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($registryPriceAlert->products as $products) : ?>
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

