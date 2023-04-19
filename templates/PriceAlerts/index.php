<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PriceAlert[]|\Cake\Collection\CollectionInterface $priceAlerts
 */
?>
<?php
$this->assign('title', __('Price Alerts'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Price Alerts'],
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
            <?= $this->Html->link(__('New Price Alert'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('brand_id') ?></th>
                    <th><?= $this->Paginator->sort('shop_id') ?></th>
                    <th><?= $this->Paginator->sort('active') ?></th>
                    <th><?= $this->Paginator->sort('type_alert_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($priceAlerts as $priceAlert) : ?>
                    <tr>
                        <td><?= $this->Number->format($priceAlert->id) ?></td>
                        <td><?= $priceAlert->has('brand') ? $this->Html->link($priceAlert->brand->name, ['controller' => 'Brands', 'action' => 'view', $priceAlert->brand->id]) : '' ?></td>
                        <td><?= $priceAlert->has('shop') ? $this->Html->link($priceAlert->shop->name, ['controller' => 'Shops', 'action' => 'view', $priceAlert->shop->id]) : '' ?></td>
                        <td><?= ($priceAlert->active) ? __('Yes') : __('No') ?></td>
                        <td><?= $priceAlert->has('type_alert') ? $this->Html->link($priceAlert->type_alert->name, ['controller' => 'TypeAlerts', 'action' => 'view', $priceAlert->type_alert->id]) : '' ?></td>
                        <td><?= h($priceAlert->created) ?></td>
                        <td><?= h($priceAlert->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $priceAlert->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $priceAlert->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $priceAlert->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $priceAlert->id)]) ?>
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
