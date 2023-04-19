<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitorPrice $competitorPrice
 */
?>
<?php
$this->assign('title', __('Edit Competitor Price'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Competitor Prices', 'url' => ['action' => 'index']],
    ['title' => 'View', 'url' => ['action' => 'view', $competitorPrice->id]],
    ['title' => 'Edit'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($competitorPrice) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('competitor_id', ['options' => $competitors]);
      echo $this->Form->control('product_id', ['options' => $products]);
      echo $this->Form->control('price');
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $competitorPrice->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $competitorPrice->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

