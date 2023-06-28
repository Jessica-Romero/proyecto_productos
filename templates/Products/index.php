<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
<?php
$this->assign('title', __('Catalogue'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Products'],
]);
?>

<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-dolly"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= __('Total products') ?></span>
                <span class="info-box-number"><?= $count_total ?></span>
            </div>
        </div>
    </div>
</div>


<div class="card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title">
            <!-- -->
        </h2>
        <div class="card-toolbox">
            <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body">
        <table id="products-datatable" class="display table table-bordered table-striped dataTable dtr-inline">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('sku') ?></th>
                <th><?= $this->Paginator->sort('image') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('brand_id') ?></th>
                <th><?= $this->Paginator->sort('Name Competitor') ?></th>
                <th><?= $this->Paginator->sort('Price Competitor') ?></th>
                <th><?= $this->Paginator->sort('Created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product) : ?>
                <tr data-row="<?= $product->id ?>">
                    <td><?= h($product->sku) ?></td>
                    <td><?= $this->Html->image(h($product->image), ['class' => 'product-thumb']) ?></td>
                    <td><?= $this->Html->link($this->Text->truncate(h($product->name), 60, ['ellipsis' => '...', 'exact' => false]), ['controller' => 'Products', 'action' => 'view', $product->id]) ?></td>
                    <td><?= h($product->brand) ? $this->Product->brandName($product->brand) : '-' ?></td>
                    <td><?= empty(!($product->competitor_prices)) ? $product->competitor_prices[0]->competitor->name : '' ?></td>
                    <td><?= empty(!($product->competitor_prices)) ? $this->Number->precision($product->competitor_prices[0]->price, 2) : '' ?></td>
                    <td><?= empty(!($product->competitor_prices)) ? $product->competitor_prices[0]->created : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $product->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
