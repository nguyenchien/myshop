<?php
    //So luong san pham trong gio hang
    $total = 0;
    $data = Yii::app()->session['cart'];
    if(isset($data)){
        foreach ($data as $item){
            $total += $item['quality'];
        }
    }
?>

<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="header">
    <div class="wrap-header flexbox">
        <h1 class="main-logo">
            <a href="<?= BASE_URL; ?>" class="float"><img src="<?= WP_URL; ?>/images/logo.jpg" alt="" width="171" height="73" /></a>
        </h1>
        <div class="wrap-topblock flexbox">
            <div class="topblock topblock1">
                <p>Lanquage:</p>
                <a href="#"><img src="<?= WP_URL; ?>/images/flag1.gif" alt="" width="19" height="11" /></a>
                <a href="#"><img src="<?= WP_URL; ?>/images/flag2.gif" alt="" width="19" height="11" /></a>
                <a href="#"><img src="<?= WP_URL; ?>/images/flag3.gif" alt="" width="19" height="11" /></a>
                <a href="#"><img src="<?= WP_URL; ?>/images/flag4.gif" alt="" width="19" height="11" /></a>
                <a href="#"><img src="<?= WP_URL; ?>/images/flag5.gif" alt="" width="19" height="11" /></a>
                <a href="#"><img src="<?= WP_URL; ?>/images/flag6.gif" alt="" width="19" height="11" /></a>
            </div>
            <div class="topblock topblock2">
                <a href="<?= BASE_URL; ?>/shoppingcart/cart" class="cart flexbox">
                    <img src="<?= WP_URL; ?>/images/shopping.gif" alt="" width="24" height="24" />
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
        Yii::app()->controller->widget('application.widgets.Menu');
    ?>
</div>
