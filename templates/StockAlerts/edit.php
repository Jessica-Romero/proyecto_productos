<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockAlert $stockAlert
 */
?>
<?php
$this->assign('title', __('Edit Stock Alert'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Stock Alerts', 'url' => ['action' => 'index']],
    ['title' => 'View', 'url' => ['action' => 'view', $stockAlert->id]],
    ['title' => 'Edit'],
]);
?>

<div class="card card-primary card-outline">
    <?= $this->Form->create($stockAlert) ?>
    <div class="card-body">
        <?php
        echo $this->Form->control('brand_id', ['options' => $brands]);?>
        <p><strong> Select products </strong></p>
        <?php
        echo $this->Form->select(
            'products._ids',
            $products,
            [
                'multiple' => true,
                'value' => array_column($stockAlert->products, 'id')
            ]
        );
        echo $this->Form->control('emails');
        echo $this->Form->control('value');
        echo $this->Form->control('active', ['custom' => true]);
        ?>
    </div>

    <div class="card-footer d-flex">
        <div class="">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $stockAlert->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $stockAlert->id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
        <div class="ml-auto">
            <?= $this->Form->button(__('Save')) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?= $this->Form->end() ?>
</div>

