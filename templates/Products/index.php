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
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-box"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= __('In stock') ?></span>
                <span class="info-box-number"><?= $count_in_stock ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fas fa-box-open"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= __('Out of stock') ?></span>
                <span class="info-box-number"><?= $count_out_of_stock ?></span>
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
            <?= $this->Paginator->limitControl([], null, [
                'label' => false,
                'class' => 'form-control-sm',
            ]); ?>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('sku') ?></th>
                <th><?= $this->Paginator->sort('image') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('brand_id') ?></th>
                <th><?= $this->Paginator->sort('cost') ?></th>
                <th><?= $this->Paginator->sort('price') ?></th>
                <th><?= $this->Paginator->sort('in_stock', ['label' => __('Availability')]) ?></th>
                <th><?= $this->Paginator->sort('stock_level') ?></th>
                <th><?= $this->Paginator->sort('sales_last_days') ?></th>
                <th><?= $this->Paginator->sort('rating') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody class="products-table">
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?= h($product->sku) ?></td>
                    <td><?= $this->Html->image(h($product->image), ['class'=>'product-thumb']) ?></td>
                    <td><?= $this->Text->truncate(h($product->name),60, ['ellipsis' => '...', 'exact' => false]); ?></td>
                    <td><?= h($product->brand)?$this->Product->brandName($product->brand):'-' ?></td>
                    <td><?= $this->Number->format($product->cost) ?></td>
                    <td><?= $this->Number->format($product->price) ?></td>
                    <td><?= $this->Product->availability($product->is_stock) ?></td>
                    <td><?= $this->Product->stockLevel($product->stock_level) ?></td>
                    <td><?= h($product->sales_last_days) ?></td>
                    <td><?= $this->Product->rating($product->rating) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $product->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->

    <div class="card-footer d-md-flex paginator">
        <div class="mr-auto" style="font-size:.8rem">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </div>
        <ul class="pagination pagination-sm">
            <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false]) ?>
        </ul>
    </div>
    <!-- /.card-footer -->
</div>
