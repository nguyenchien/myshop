<?php
/* @var $this DefaultController */
$this->breadcrumbs = array( $this->module->id );
?>

<div class="menu-control-admin">
    <h2 class="title">Menu Administrator</h2>
    <div class="content flexbox">
        <ul class="list-menu-admin">
            <li><a href="<?= BASE_URL; ?>/admin/category/admin">Category</a></li>
            <li><a href="<?= BASE_URL; ?>/admin/product/admin">Product</a></li>
            <li><a href="<?= BASE_URL; ?>/admin/order/admin">Order</a></li>
            <li><a href="<?= BASE_URL; ?>/admin/users/admin">Users</a></li>
            <li><a href="<?= BASE_URL; ?>/wordpress/wp-admin">CMS Wordpress</a></li>
        </ul>
        <div class="info-menu-admin">
            <p class="brief">Welcome to EShop Administrator!!!</p>
        </div>
    </div>
</div>