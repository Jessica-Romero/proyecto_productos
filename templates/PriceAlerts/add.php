<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PriceAlert $priceAlert
 */
?>
<?php
$this->assign('title', __('Add Price Alert'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Price Alerts', 'url' => ['action' => 'index']],
    ['title' => 'Add'],
]);
?>

<div class="card card-primary card-outline">
    <?= $this->Form->create($priceAlert) ?>
    <div class="card-body">
        <?php
        echo $this->Form->control('brand_id', ['options' => $brands]); ?>
        <p><strong> Select products </strong></p>
        <?php
        echo $this->Form->select(
            'products._ids',
            $products,
            [
                'multiple' => true,
                'id' => 'products_id',
            ]
        );
        echo $this->Form->control('type_alert_id', ['options' => $typeAlerts]);
        echo $this->Form->control('shop_id', ['options' => $shops]);
        echo $this->Form->control('emails');
        echo $this->Form->control('active', ['custom' => true]);
        ?>
    </div>

    <div class="card-footer d-flex">
        <div class="ml-auto">
            <?= $this->Form->button(__('Save')) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?= $this->Form->end() ?>
</div>

