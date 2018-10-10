<?php
    $baseUrl = Yii::app()->request->baseUrl;
?>
<div class="menu-top flexbox">
    <ul class="list-menu-top flexbox">
        <li><a href="<?=$baseUrl;?>">Home</a></li>
        <li><a href="<?=$baseUrl;?>/about">About</a></li>
        <li><a href="<?=$baseUrl;?>/faqs">FAQs</a></li>
        <li><a href="<?=$baseUrl;?>/contact">Contact Us</a></li>
    </ul>
    <ul class="user-menu flexbox">
        <?php if(Yii::app()->user->isGuest): ?>
            <li><a href="<?=$baseUrl;?>/site/register">Register</a></li>
            <li><a href="<?=$baseUrl;?>/site/login">Login</a></li>
        <?php else: ?>
            <li class="user-logged">Hello: <a href="<?= BASE_URL; ?>/admin"><?= $data['user_name']; ?></a></li>
            <li><a href="<?=$baseUrl;?>/site/logout">Logout</a></li>
        <?php endif; ?>
    </ul>
</div>