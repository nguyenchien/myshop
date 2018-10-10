<?php
    /**
     * Template Name: Two Column
     *
     * This is the template that displays all pages by default.
     * Please note that this is the WordPress construct of pages
     * and that other 'pages' on your WordPress site may use a
     * different template.
     *
     * @link https://codex.wordpress.org/Template_Hierarchy
     *
     * @package WordPress
     * @subpackage Twenty_Seventeen
     * @since 1.0
     * @version 1.0
     */
    get_header();
?>
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
                <?php
                    while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>