<?php
/**
 * The theme header
 * 
 * @package bootstrap-basic
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>     <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>     <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width">

        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        
        <!--wordpress head-->
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <?php 
        if ( function_exists( 'wp_body_open' ) ) {
            wp_body_open();
        } else {
            do_action( 'wp_body_open' );
        }
        ?> 
        <!--[if lt IE 8]>
            <p class="ancient-browser-alert">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/" target="_blank">upgrade your browser</a>.</p>
        <![endif]-->
        
        
        <div id="page" class="hfeed site advanced-search">
            <?php do_action('before'); ?> 
                        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="container">
<div class="row">
                            <div class="navbar-header col-xs-6 col-md-2">
<a class="navbar-brand" href="/">
<img src="/wp-content/themes/cooperhewitt/assets/images/cooper-hewitt-logo.svg" alt="Cooper Hewitt">
</a>
                            </div>
                            
                            <div class="collapsed-nav">
                                <?php 
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'primary', 
                                        'container' => false, 
                                        'depth' => 2,
                                        'menu_class' => 'nav navbar-nav', 
                                        'walker' => new BootstrapBasicMyWalkerNavMenu(),
                                    )
                                ); 
                                ?> 
                                <?php dynamic_sidebar('navbar-right'); ?> 
                            </div><!--.navbar-collapse-->
</div>
</div>
                        </nav>
            <div id="content">
