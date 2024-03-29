<?php

/**
 * @var \App\View\AppView $this
 * @var \CakeLte\View\Helper\CakeLteHelper $this->CakeLte
 */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') . ' | ' . strip_tags($this->CakeLte->getConfig('app-name')) ?></title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <?= $this->Html->css('CakeLte./AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>
    <!-- Select2 -->
    <?= $this->Html->css('CakeLte./AdminLTE/plugins/select2/css/select2.min.css') ?>
    <!-- Theme style -->
    <?= $this->Html->css('CakeLte./AdminLTE/dist/css/adminlte.min.css') ?>
    <?= $this->Html->css('CakeLte.style') ?>
    <?= $this->Html->css('catalogue') ?>
    <?= $this->element('layout/css') ?>
    <?= $this->fetch('css') ?>
    <?php echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
</head>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <?= $this->CakeLte->getConfig('app-name') ?>
    </div>
    <!-- /.login-logo -->
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<?= $this->Html->script('CakeLte./AdminLTE/plugins/jquery/jquery.min.js') ?>
<!-- Bootstrap 4 -->
<?= $this->Html->script('CakeLte./AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>
<!-- AdminLTE App -->
<?= $this->Html->script('CakeLte./AdminLTE/dist/js/adminlte.min.js') ?>
<!-- Select2 -->
<?= $this->Html->script('CakeLte./AdminLTE/plugins/select2/js/select2.js') ?>
<!-- abg.js -->
<?= $this->Html->script('/js/catalogue.js') ?>
<?= $this->element('layout/script') ?>
<?= $this->fetch('script') ?>
</body>

</html>
