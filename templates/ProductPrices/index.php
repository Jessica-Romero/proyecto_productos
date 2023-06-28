<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductPrice[]|\Cake\Collection\CollectionInterface $productPrices
 */
?>
<?php
$this->assign('title', __('Product Prices'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Product Prices'],
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
                    <th><?= $this->Paginator->sort('cost') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productPrices as $productPrice) : ?>
                    <tr>
                        <td><?= $this->Number->format($productPrice->id) ?></td>
                        <td><?= $productPrice->has('product') ? $this->Html->link($productPrice->product->name, ['controller' => 'Products', 'action' => 'view', $productPrice->product->id]) : '' ?></td>
                        <td><?= $productPrice->has('shop') ? $this->Html->link($productPrice->shop->name, ['controller' => 'Shops', 'action' => 'view', $productPrice->shop->id]) : '' ?></td>
                        <td><?= $this->Number->format($productPrice->cost) ?></td>
                        <td><?= $this->Number->format($productPrice->price) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $productPrice->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $productPrice->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $productPrice->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
