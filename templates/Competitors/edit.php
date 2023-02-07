<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Competitor $competitor
 */
?>
<?php
$this->assign('title', __('Edit Competitor'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Competitors', 'url' => ['action' => 'index']],
    ['title' => 'View', 'url' => ['action' => 'view', $competitor->id]],
    ['title' => 'Edit'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($competitor) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('name');
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $competitor->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $competitor->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

