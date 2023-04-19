<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockAlert $stockAlert
 */
?>

<?php
$this->assign('title', __('Stock Alert'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Stock Alerts', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<div class="view card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title"><?= h($stockAlert->id) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Brand') ?></th>
                <td><?= $stockAlert->has('brand') ? $this->Html->link($stockAlert->brand->name, ['controller' => 'Brands', 'action' => 'view', $stockAlert->brand->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($stockAlert->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Value') ?></th>
                <td><?= $this->Number->format($stockAlert->value) ?></td>
            </tr>
            <tr>
                <th><?= __('Created') ?></th>
                <td><?= h($stockAlert->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Modified') ?></th>
                <td><?= h($stockAlert->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Active') ?></th>
                <td><?= $stockAlert->active ? __('Yes') : __('No'); ?></td>
            </tr>
        </table>
    </div>
    <div class="card-footer d-flex">
        <div>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $stockAlert->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $stockAlert->id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
        <div class="ml-auto">
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $stockAlert->id], ['class' => 'btn btn-secondary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>

<div class="view text card">
    <div class="card-header">
        <h3 class="card-title"><?= __('Emails') ?></h3>
    </div>
    <div class="card-body">
        <?= $this->Text->autoParagraph(h($stockAlert->emails)); ?>
    </div>
</div>

<div class="view text card">
    <div class="card-header">
        <h3 class="card-title"><?= __('Products') ?></h3>
    </div>
    <div class="card-body">
        <?php if(empty(!($stockAlert->products))){
            foreach($stockAlert->products as $product): ?>
                <?= $this->Html->link($product->name, ['controller' => 'Products', 'action' => 'view', $product->id]); ?>
            <?php endforeach;
        } else print_r('All products have been selected');
        ?>
    </div>
</div>
