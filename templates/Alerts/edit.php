<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Alert $alert
 */
?>
<?php
$this->assign('title', __('Edit Alert'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Alerts', 'url' => ['action' => 'index']],
    ['title' => 'View', 'url' => ['action' => 'view', $alert->id]],
    ['title' => 'Edit'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($alert) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('name');
      echo $this->Form->control('type_alert_id', ['options' => $typeAlerts]);
      echo $this->Form->control('params');
      echo $this->Form->control('information');
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $alert->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $alert->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

