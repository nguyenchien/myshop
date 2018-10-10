<?php
    $baseUrl = Yii::app()->getBaseUrl(true);
    $userInfo = Yii::app()->user->getState('userInfo');
?>

<div class="breadcrumb">
    <div class="tree">
        <a href="<?= $baseUrl; ?>">Home</a>
        <span class="separate">&gt;</span>
        <a href="<?= $baseUrl; ?>/shoppingcart/cart">Cart</a>
        <span class="separate">&gt;</span>
        <a href="<?= $baseUrl; ?>/shoppingcart/confirm">Confirm</a>
        <span class="separate">&gt;</span>
        <span class="text active">Payment</span>
        <span class="separate">&gt;</span>
        <span class="text">Finish</span>
    </div>
</div>

<div class="wrap-payment">
    <form action="<?= $baseUrl ?>/shoppingcart/finish" method="post">
        <?php if($userInfo): ?>
            <h3 class="title">Information User Payment</h3>
            <ul class="list-info-user user">
                <li class="flexbox">
                    <p class="text">Name :</p>
                    <p class="info"><?= $userInfo["user_name"]; ?></p>
                </li>
                <li class="flexbox">
                    <p class="text">Email :</p>
                    <p class="info"><?= $userInfo["email"]; ?></p>
                </li>
                <li class="flexbox">
                    <p class="text">Phone :</p>
                    <p class="info"><?= $userInfo["phone"]; ?></p>
                </li>
                <li class="flexbox">
                    <p class="text">Address :</p>
                    <p class="info"><?= $userInfo["address"]; ?></p>
                </li>
            </ul>
        <?php else: ?>
            <p class="note">Please fill all information for bellow form</p>
            <ul class="list-info-user guess">
                <li class="flexbox">
                    <p class="text">Name :</p>
                    <p class="info"><input type="text" name="username"></p>
                </li>
                <li class="flexbox">
                    <p class="text">Email :</p>
                    <p class="info"><input type="email" name="email"></p>
                </li>
                <li class="flexbox">
                    <p class="text">Phone :</p>
                    <p class="info"><input type="tel" name="phone"></p>
                </li>
                <li class="flexbox">
                    <p class="text">Address :</p>
                    <p class="info"><input type="text" name="address"></p>
                </li>
            </ul>
        <?php endif; ?>
        <div class="check-out">
            <input class="btn-action finish" type="submit" value="Finish" name="finish">
        </div>
    </form>
</div>