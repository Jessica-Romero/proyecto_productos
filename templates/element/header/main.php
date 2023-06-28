<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>

    <?= $this->element('header/menu') ?>
</ul>
<li class="nav-item d-none d-sm-inline-block">
    <?= $this->Html->link(__('logout'), '/users/logout', ['class' => 'nav-link']) ?>
</li>
<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
        </a>
    </li>
</ul>
