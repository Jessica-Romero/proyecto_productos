<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitorPrice $competitorPrice
 */
?>

<?php
$this->assign('title', __('Competitor Price'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Competitor Prices', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($competitorPrice->id) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Competitor') ?></th>
            <td><?= $competitorPrice->has('competitor') ? $this->Html->link($competitorPrice->competitor->name, ['controller' => 'Competitors', 'action' => 'view', $competitorPrice->competitor->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Product') ?></th>
            <td><?= $competitorPrice->has('product') ? $this->Html->link($competitorPrice->product->name, ['controller' => 'Products', 'action' => 'view', $competitorPrice->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($competitorPrice->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Price') ?></th>
            <td><?= $this->Number->format($competitorPrice->price) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($competitorPrice->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($competitorPrice->modified) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $competitorPrice->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $competitorPrice->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $competitorPrice->id], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>
</div>


