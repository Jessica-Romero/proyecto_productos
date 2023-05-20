.<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        $connection = ConnectionManager::get($name);
        $connected = $connection->connect();
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
    }

    return compact('connected', 'error');
};

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') . ' | ' . strip_tags($this->CakeLte->getConfig('app-name')) ?></title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <?= $this->Html->css('CakeLte./AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>
    <!-- Theme style -->
    <?= $this->Html->css('CakeLte./AdminLTE/dist/css/adminlte.min.css') ?>
    <?= $this->Html->css('catalogue') ?>
    <?= $this->element('layout/css') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
<header>
    <div class="container text-center">
        <img alt="CakePHP" src="/img/catalogue-portada.svg" width="450" />
        <a class="abg-header" href="/login" class="button-login">Login</a>
    </div>
</header>
<div class="flex text-center items-center justify-center">
    <h2 class="flex flex-col mt-70 mb-70">
        <span class="font-bold title font-size-xxl">Welcome to</span>
        <span class="max-content title-light p-4 font-size-xxxl">CATALOGUE PRODUCTS</span>
    </h2>
    <a class="downArrow bounce" href="#container"><img src="img/arrow-down.svg"></a>

</body>
</html>
<!-- jQuery -->
<?= $this->Html->script('CakeLte./AdminLTE/plugins/jquery/jquery.min.js') ?>
