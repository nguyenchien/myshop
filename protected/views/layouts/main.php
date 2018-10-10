<?php get_header(); ?>

<div id="container" class="flexbox">
    <div id="left">
        <div class="wrap-menu">
            <img class="title-cate" src="<?= WP_URL; ?>/images/title1.gif" alt="" />
            <?php
                //Call Widget Navigation
                Yii::app()->controller->widget('application.widgets.Navigation');
            ?>
        </div>
        <ul class="list-banner-top list-banner-top-left">
            <li><a href="#"><img src="<?= WP_URL; ?>/images/banner-left-1.jpg" alt="" /></a></li>
            <li><a href="#"><img src="<?= WP_URL; ?>/images/banner-left-2.jpg" alt="" /></a></li>
        </ul>
    </div>
    <div id="center">
        <div id="content">
            <?= $content; ?>
        </div>
    </div>
    <div id="right">
        <ul class="list-banner-top list-banner-top-right">
            <li><a href="#"><img src="<?= WP_URL; ?>/images/banner-right-1.jpg" alt="" /></a></li>
            <li><a href="#"><img src="<?= WP_URL; ?>/images/banner-right-2.jpg" alt="" /></a></li>
            <li><a href="#"><img src="<?= WP_URL; ?>/images/banner-right-3.jpg" alt="" /></a></li>
            <li><a href="#"><img src="<?= WP_URL; ?>/images/banner-right-4.jpg" alt="" /></a></li>
            <li><a href="#"><img src="<?= WP_URL; ?>/images/banner-right-5.jpg" alt="" /></a></li>
        </ul>
    </div>
</div>

<?php get_footer(); ?>