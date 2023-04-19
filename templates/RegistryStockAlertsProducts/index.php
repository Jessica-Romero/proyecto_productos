<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistryStockAlertsProduct[]|\Cake\Collection\CollectionInterface $registryStockAlertsProducts
 */
?>
<?php
$this->assign('title', __('Registry Stock Alerts Products'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Registry Stock Alerts Products'],
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
            <?= $this->Html->link(__('New Registry Stock Alerts Product'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('registry_stock_alert_id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('available_stock') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registryStockAlertsProducts as $registryStockAlertsProduct) : ?>
                    <tr>
                        <td><?= $this->Number->format($registryStockAlertsProduct->id) ?></td>
                        <td><?= $registryStockAlertsProduct->has('registry_stock_alert') ? $this->Html->link($registryStockAlertsProduct->registry_stock_alert->id, ['controller' => 'RegistryStockAlerts', 'action' => 'view', $registryStockAlertsProduct->registry_stock_alert->id]) : '' ?></td>
                        <td><?= $registryStockAlertsProduct->has('product') ? $this->Html->link($registryStockAlertsProduct->product->name, ['controller' => 'Products', 'action' => 'view', $registryStockAlertsProduct->product->id]) : '' ?></td>
                        <td><?= $this->Number->format($registryStockAlertsProduct->available_stock) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $registryStockAlertsProduct->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $registryStockAlertsProduct->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $registryStockAlertsProduct->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $registryStockAlertsProduct->id)]) ?>
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
