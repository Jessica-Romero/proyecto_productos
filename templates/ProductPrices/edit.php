<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductPrice $productPrice
 */
?>
<?php
$this->assign('title', __('Edit Product Price'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Product Prices', 'url' => ['action' => 'index']],
    ['title' => 'View', 'url' => ['action' => 'view', $productPrice->id]],
    ['title' => 'Edit'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($productPrice) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('product_id', ['options' => $products]);
      echo $this->Form->control('shop_id', ['options' => $shops]);
      echo $this->Form->control('cost');
      echo $this->Form->control('price');
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $productPrice->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $productPrice->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

