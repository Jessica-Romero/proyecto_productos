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
            <!-- -->
        </h2>
        <div class="card-toolbox">
            <?= $this->Paginator->limitControl([], null, [
                'label' => false,
                'class' => 'form-control-sm',
            ]); ?>
            <?= $this->Html->link(__('New Product Stock'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
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
                        <td><?= ($productStock->in_stock) ? __('Yes') : __('No') ?></td>
                        <td><?= $this->Number->format($productStock->stock_level) ?></td>
                        <td><?= $this->Number->format($productStock->sales_last_days) ?></td>
                        <td><?= h($productStock->rating) ?></td>
                        <td><?= h($productStock->created) ?></td>
                        <td><?= h($productStock->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $productStock->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $productStock->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $productStock->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $productStock->id)]) ?>
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
