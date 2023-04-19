<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Alert $alert
 */
?>

<?php
$this->assign('title', __('Alert'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Alerts', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>
<div class="view card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title"> View <?= $name ?> Alert</h2>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <?php foreach (array_keys($xAlertInfo) as $title): ?>
                    <th><?= $title ?></th>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($xAlertInfo as $info): ?>
                    <td><?= $info ?></td>
                <?php endforeach; ?>
            </tr>
        </table>
    </div>
    <div class="view text card">
        <div class="card-header">
            <h3 class="card-title"><?= __('Emails') ?></h3>
        </div>
        <div class="card-body">
            <?= $this->Text->autoParagraph(h($emails)); ?>
        </div>
    </div>
    <div class="view text card">
        <div class="card-header">
            <h3 class="card-title"><?= __('Products') ?></h3>
        </div>
        <div class="card-body">
            <?php if(empty(!($products))){
                foreach($products as $product): ?>
                    <?= $this->Html->link($product['name'], ['controller' => 'Products', 'action' => 'view', $product['id']]); ?>
                <?php endforeach;
            } else print_r('All products have been selected');
            ?>
        </div>
    </div>

    <div class="related related-products view card">
        <div class="card-header d-sm-flex">
            <h3 class="card-title"><?= __('Affected Products') ?></h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <tr>
                    <?php if(empty(!($productsAffected))){
                        foreach (array_keys($productsAffected[0]) as $title): ?>
                            <th><?= $title ?></th>
                        <?php endforeach;
                    } ?>
                </tr>

                <?php if (empty($productsAffected)) { ?>
                    <tr>
                        <td colspan="8" class="text-muted">
                            Products record not found!
                        </td>
                    </tr>
                <?php }else{ ?>
                    <?php foreach ($productsAffected as $product): ?>
                        <tr>
                            <?php foreach ($product as $info):?>
                                <td><?= $info ?></td>
                            <?php endforeach ?>
                        </tr>
                    <?php endforeach; ?>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
