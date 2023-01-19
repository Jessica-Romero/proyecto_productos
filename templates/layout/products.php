<?php

/**
 * @var \App\View\AppView $this
 * @var \CakeLte\View\Helper\CakeLteHelper $this- >CakeLte
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
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <?= $this->Html->css('CakeLte./AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>
    <!-- flag-icon-css -->
    <?= $this->Html->css('CakeLte./AdminLTE/plugins/flag-icon-css/css/flag-icon.min.css') ?>
    <!-- Select2 -->
    <?= $this->Html->css('CakeLte./AdminLTE/plugins/select2/css/select2.min.css') ?>
    <!-- Sweet Alert 2 -->
    <?= $this->Html->css('CakeLte./AdminLTE/plugins/sweetalert2/sweetalert2.min.css') ?>
    <!-- Dropzone -->
    <?= $this->Html->css('CakeLte./AdminLTE/plugins/dropzone/min/basic.min.css') ?>
    <?= $this->Html->css('CakeLte./AdminLTE/plugins/dropzone/min/dropzone.min.css') ?>
    <!-- Datatables -->
    <?= $this->Html->css('CakeLte./AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>
    <?= $this->Html->css('CakeLte./AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>
    <!-- Theme style -->
    <?= $this->Html->css('CakeLte./AdminLTE/dist/css/adminlte.min.css') ?>
    <!-- Bs stepper -->
    <?= $this->Html->css('CakeLte./AdminLTE/plugins/bs-stepper/css/bs-stepper.min.css') ?>
    <?= $this->Html->css('CakeLte./AdminLTE/plugins/fullcalendar/main.css') ?>
    <?= $this->Html->css('CakeLte.style') ?>
    <?= $this->Html->css('catalogue') ?>
    <?= $this->Html->css('promotions') ?>
    <?= $this->Html->css('tables') ?>
    <?= $this->element('layout/css') ?>
    <?= $this->fetch('css') ?>

    <?php echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
</head>

<body class="hold-transition <?= $this->CakeLte->getBodyClass() ?>">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand <?= $this->CakeLte->getHeaderClass() ?>">
        <?= $this->element('header/main') ?>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar <?= $this->CakeLte->getSidebarClass() ?>">
        <!-- Brand Logo -->
        <a href="<?= $this->Url->build('/') ?>" class="brand-link">
            <?= $this->Html->image($this->CakeLte->getConfig('app-logo'), ['alt' => $this->CakeLte->getConfig('app-name') . ' logo', 'class' => 'brand-image']) ?>
            <span class="brand-text font-weight-light"><?= $this->CakeLte->getConfig('app-name') ?></span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <?= $this->element('sidebar/main') ?>
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <?= $this->element('content/header') ?>
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <?= $this->element('products/filters') ?>
        <?= $this->element('aside/main') ?>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <?= $this->element('footer/main') ?>
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<?= $this->Html->script('CakeLte./AdminLTE/plugins/jquery/jquery.min.js') ?>
<!-- Bootstrap 4 -->
<?= $this->Html->script('CakeLte./AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>
<!-- AdminLTE App -->
<?= $this->Html->script('CakeLte./AdminLTE/dist/js/adminlte.min.js') ?>
<!-- Bs Stepper -->
<?= $this->Html->script('CakeLte./AdminLTE/plugins/bs-stepper/js/bs-stepper.min.js') ?>
<!-- Select2 -->
<?= $this->Html->script('CakeLte./AdminLTE/plugins/select2/js/select2.js') ?>
<!-- Sweet Alert 2 -->
<?= $this->Html->script('CakeLte./AdminLTE/plugins/sweetalert2/sweetalert2.min.js') ?>
<!-- Dropzone -->
<?= $this->Html->script('CakeLte./AdminLTE/plugins/dropzone/min/dropzone.min.js') ?>
<!-- Datatable -->
<?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>
<?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.js') ?>
<?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables-buttons/js/buttons.html5.js') ?>
<?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables-buttons/js/buttons.flash.js') ?>
<?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.js') ?>
<?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables-buttons/js/buttons.print.js') ?>
<?= $this->Html->script('CakeLte./AdminLTE/plugins/datatables-buttons/js/buttons.colVis.js') ?>
<!-- abg.js -->
<?= $this->Html->script('/js/abg.js') ?>
<!-- products.js -->
<?= $this->Html->script('/js/products.js') ?>
<?= $this->element('layout/script') ?>
<?= $this->fetch('script') ?>
</body>

</html>
