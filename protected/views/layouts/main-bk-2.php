<?php
    $baseUrl = Yii::app()->request->baseUrl;
    $isHome = Yii::app()->controller->action->id == "index" ? true : false;

    //So luong san pham trong gio hang
    $total = 0;
    $data = Yii::app()->session['cart'];
    if(isset($data)){
        foreach ($data as $item){
            $total += $item['quality'];
        }
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>E-Shop</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <script type="text/javascript" src="<?= $baseUrl; ?>/data/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= $baseUrl; ?>/data/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?= $baseUrl; ?>/data/css/style.css" />
</head>
<body>
<div id="header">
    <div class="wrap-header flexbox">
        <h1 class="main-logo">
            <a href="<?=$baseUrl?>" class="float"><img src="<?=$baseUrl?>/data/images/logo.jpg" alt="" width="171" height="73" /></a>
        </h1>
        <div class="wrap-topblock flexbox">
            <div class="topblock topblock1">
                <p>Lanquage:</p>
                <a href="#"><img src="<?=$baseUrl?>/data/images/flag1.gif" alt="" width="19" height="11" /></a>
                <a href="#"><img src="<?=$baseUrl?>/data/images/flag2.gif" alt="" width="19" height="11" /></a>
                <a href="#"><img src="<?=$baseUrl?>/data/images/flag3.gif" alt="" width="19" height="11" /></a>
                <a href="#"><img src="<?=$baseUrl?>/data/images/flag4.gif" alt="" width="19" height="11" /></a>
                <a href="#"><img src="<?=$baseUrl?>/data/images/flag5.gif" alt="" width="19" height="11" /></a>
                <a href="#"><img src="<?=$baseUrl?>/data/images/flag6.gif" alt="" width="19" height="11" /></a>
            </div>
            <div class="topblock topblock2">
                <a href="<?=$baseUrl?>/shoppingcart/cart" class="cart flexbox">
                    <img id="imgCart" src="<?=$baseUrl?>/data/images/shopping.gif" alt="" width="24" height="24" />
                    <div class="text">
                        <p>Shopping cart</p>
                        <p><span id="quaCart"><?=$total;?></span> <span>items</span></p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <?php
        //Call Widget Menu
        $this->widget('application.widgets.Menu');
    ?>
</div>

<div id="container" class="flexbox">
    <div id="left" class="column">
        <div class="wrap-menu">
            <img src="<?=$baseUrl?>/data/images/title1.gif" alt="" />
            <?php
                //Call Widget Navigation
                $this->widget('application.widgets.Navigation');
            ?>
        </div>
        <ul class="list-banner-top list-banner-top-left">
            <li><a href="#"><img src="<?=$baseUrl?>/data/images/banner-left-1.jpg" alt="" /></a></li>
            <li><a href="#"><img src="<?=$baseUrl?>/data/images/banner-left-2.jpg" alt="" /></a></li>
        </ul>
    </div>
    <div id="center" class="column">
        <?php
            //Call Widget SlideShow for Home Page
            if($isHome){
                $this->widget('application.widgets.SlideShow');
            }
        ?>
        <div id="content">
            <?= $content; ?>
        </div>
    </div>
    <div id="right" class="column">
        <ul class="list-banner-top list-banner-top-right">
            <li><a href="#"><img src="<?=$baseUrl?>/data/images/banner-right-1.jpg" alt="" /></a></li>
            <li><a href="#"><img src="<?=$baseUrl?>/data/images/banner-right-2.jpg" alt="" /></a></li>
            <li><a href="#"><img src="<?=$baseUrl?>/data/images/banner-right-3.jpg" alt="" /></a></li>
            <li><a href="#"><img src="<?=$baseUrl?>/data/images/banner-right-4.jpg" alt="" /></a></li>
            <li><a href="#"><img src="<?=$baseUrl?>/data/images/banner-right-5.jpg" alt="" /></a></li>
        </ul>
    </div>
</div>

<div id="footer">
    <ul class="menu-footer flexbox">
        <li><a href="#">Blog</a></li>
        <li><a href="#">Policy</a></li>
        <li><a href="#">Notation</a></li>
        <li><a href="#">Recruitment</a></li>
    </ul>
    <p class="copy-right">Copyright 2016 E-SHOP. All Rights Reserved.</p>
</div>
</body>
</html>