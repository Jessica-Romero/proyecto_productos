<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegistryPriceAlertsProduct[]|\Cake\Collection\CollectionInterface $registryPriceAlertsProducts
 */
?>
<?php
$this->assign('title', __('Registry Price Alerts Products'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Registry Price Alerts Products'],
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
            <?= $this->Html->link(__('New Registry Price Alerts Product'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('registry_price_alert_id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th><?= $this->Paginator->sort('competitor_price') ?></th>
                    <th><?= $this->Paginator->sort('competitor_name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registryPriceAlertsProducts as $registryPriceAlertsProduct) : ?>
                    <tr>
                        <td><?= $this->Number->format($registryPriceAlertsProduct->id) ?></td>
                        <td><?= $registryPriceAlertsProduct->has('registry_price_alert') ? $this->Html->link($registryPriceAlertsProduct->registry_price_alert->id, ['controller' => 'RegistryPriceAlerts', 'action' => 'view', $registryPriceAlertsProduct->registry_price_alert->id]) : '' ?></td>
                        <td><?= $registryPriceAlertsProduct->has('product') ? $this->Html->link($registryPriceAlertsProduct->product->name, ['controller' => 'Products', 'action' => 'view', $registryPriceAlertsProduct->product->id]) : '' ?></td>
                        <td><?= $this->Number->format($registryPriceAlertsProduct->price) ?></td>
                        <td><?= $this->Number->format($registryPriceAlertsProduct->competitor_price) ?></td>
                        <td><?= h($registryPriceAlertsProduct->competitor_name) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $registryPriceAlertsProduct->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $registryPriceAlertsProduct->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $registryPriceAlertsProduct->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $registryPriceAlertsProduct->id)]) ?>
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
