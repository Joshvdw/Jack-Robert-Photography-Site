<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;1,100;1,300;1,400;1,700&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head()?>
</head>
<body <?php body_class(); ?>>
    <div class="menu-wrapper">
        <div class="main-logo-container">
            <a href="<?php echo home_url(); ?>"><img src="<?php bloginfo('stylesheet_directory');?>/images/main-logo.png" class="main-logo-header" alt="Jack Robert Photography Logo"></a>
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
