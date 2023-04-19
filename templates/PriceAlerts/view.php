<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PriceAlert $priceAlert
 */
?>

<?php
$this->assign('title', __('Price Alert'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Price Alerts', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<div class="view card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title"><?= h($priceAlert->id) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Brand') ?></th>
                <td><?= $priceAlert->has('brand') ? $this->Html->link($priceAlert->brand->name, ['controller' => 'Brands', 'action' => 'view', $priceAlert->brand->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Shop') ?></th>
                <td><?= $priceAlert->has('shop') ? $this->Html->link($priceAlert->shop->name, ['controller' => 'Shops', 'action' => 'view', $priceAlert->shop->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($priceAlert->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Created') ?></th>
                <td><?= h($priceAlert->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Modified') ?></th>
                <td><?= h($priceAlert->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('Active') ?></th>
                <td><?= $priceAlert->active ? __('Yes') : __('No'); ?></td>
            </tr>
        </table>
    </div>
    <div class="card-footer d-flex">
        <div class="">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $priceAlert->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $priceAlert->id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
        <div class="ml-auto">
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $priceAlert->id], ['class' => 'btn btn-secondary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>

<div class="view text card">
    <div class="card-header">
        <h3 class="card-title"><?= __('Emails') ?></h3>
    </div>
    <div class="card-body">
        <?= $this->Text->autoParagraph(h($priceAlert->emails)); ?>
    </div>
</div>

<div class="view text card">
    <div class="card-header">
        <h3 class="card-title"><?= __('Products') ?></h3>
    </div>
    <div class="card-body">
        <?php if(empty(!($priceAlert->products))){
            foreach($priceAlert->products as $product): ?>
                <?= $this->Html->link($product->name, ['controller' => 'Products', 'action' => 'view', $product->id]); ?>
            <?php endforeach;
        } else print_r('All products have been selected');
        ?>
    </div>
</div>
