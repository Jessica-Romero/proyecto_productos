<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductStock[]|\Cake\Collection\CollectionInterface $productStock
 */
?>
<?php
$this->assign('title', __('Product Stock'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Product Stock'],
]);
?>

<div class="card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title">
        </h2>
        <div class="card-toolbox">
            <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="products-datatable" class="display table table-bordered table-striped dataTable dtr-inline">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('shop_id') ?></th>
                    <th><?= $this->Paginator->sort('in_stock') ?></th>
                    <th><?= $this->Paginator->sort('stock_level') ?></th>
                    <th><?= $this->Paginator->sort('sales_last_days') ?></th>
                    <th><?= $this->Paginator->sort('rating') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productStock as $productStock) : ?>
                    <tr>
                        <td><?= $this->Number->format($productStock->id) ?></td>
                        <td><?= $productStock->has('product') ? $this->Html->link($productStock->product->name, ['controller' => 'Products', 'action' => 'view', $productStock->product->id]) : '' ?></td>
                        <td><?= $productStock->has('shop') ? $this->Html->link($productStock->shop->name, ['controller' => 'Shops', 'action' => 'view', $productStock->shop->id]) : '' ?></td>
                        <td><?= $this->Product->availability($productStock->in_stock) ?></td>
                        <td><?= $this->Product->stockLevel($productStock->stock_level) ?></td>
                        <td><?= $this->Number->format($productStock->sales_last_days) ?></td>
                        <td><?= $this->Product->rating($productStock->rating) ?></td>
                        <td><?= h($productStock->created) ?></td>
                        <td><?= h($productStock->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $productStock->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $productStock->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $productStock->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
