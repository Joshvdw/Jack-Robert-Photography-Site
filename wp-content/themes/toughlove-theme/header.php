<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head()?>
</head>
<body <?php body_class(); ?>>
    <div class="menu-wrapper">
        <div class="main-logo">
            <a href="/toughlove-redesign"><img src="<?php bloginfo('stylesheet_directory');?>/images/logo-white.png" alt="Toughlove Logo"></a>
        </div>
        <div class="custom-menu topnav" id="myTopnav">
            <div class="desktop-menu">
                <?php $args = ['theme_location' => 'primary']; ?>
                <?php wp_nav_menu($args) ?>
            </div>
            <div class="mobile-nav">
                <div class="hamburger-menu">
                    <a href="javascript:void(0);" class="icon" onclick="hamburgerMenu()">
                        <i class="fa fa-bars fa-2x" id="icon"></i>
                    </a>
                </div>
                <div class="dropdown" id="dropdown">
                    <?php $args = ['theme_location' => 'primary']; ?>
                    <?php wp_nav_menu($args) ?>
                </div>
            </div>
        </div>
    </div>