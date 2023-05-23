<!-- Add icons to the links using the .nav-icon class
     with font-awesome or any other icon font library -->
<li class="nav-item has-treeview menu-open">
    <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Catalogue Products
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <?= $this->Html->link('<i class="fas  nav-icon "></i> Products', ['controller' => 'Products', 'action' => 'index'], ['escape' => false, 'class' => 'nav-link active']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link('<i class="fas  nav-icon "></i> Product Prices', ['controller' => 'ProductPrices', 'action' => 'index'], ['escape' => false, 'class' => 'nav-link active']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link('<i class="fas  nav-icon "></i> Product Stock', ['controller' => 'ProductStock', 'action' => 'index'], ['escape' => false, 'class' => 'nav-link active']) ?>
        </li>
    </ul>
</li>

<li class="nav-item has-treeview menu-open">
    <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Alerts Products
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <?= $this->Html->link('<i class="fas  nav-icon "></i> Alerts', ['controller' => 'Alerts', 'action' => 'index'], ['escape' => false, 'class' => 'nav-link active']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link('<i class="fas  nav-icon "></i> Stock Alerts', ['controller' => 'StockAlerts', 'action' => 'index'], ['escape' => false, 'class' => 'nav-link active']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link('<i class="fas  nav-icon "></i> Price Alerts', ['controller' => 'PriceAlerts', 'action' => 'index'], ['escape' => false, 'class' => 'nav-link active']) ?>
        </li>
    </ul>
</li>


<li class="nav-item has-treeview menu-open">
    <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            New Type Alert
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <?= $this->Html->link('<i class="fas  nav-icon "></i> Create Stock Alert', ['controller' => 'StockAlerts', 'action' => 'add'], ['escape' => false, 'class' => 'nav-link active']) ?>
        </li>
        <li class="nav-item">
            <?= $this->Html->link('<i class="fas  nav-icon "></i> Create Price Alert', ['controller' => 'PriceAlerts', 'action' => 'add'], ['escape' => false, 'class' => 'nav-link active']) ?>
        </li>
    </ul>
</li>

