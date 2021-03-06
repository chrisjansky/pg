<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
<meta charset="utf-8">

<?php // force Internet Explorer to use the latest rendering engine available ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title><?php wp_title(''); ?></title>

<?php // mobile meta (hooray!) ?>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<meta name="author" content="Christian Jánský &mdash; http://www.chrisjansky.cz">

<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">

<?php // wordpress head functions ?>
<?php wp_head(); ?>
<?php // end of wordpress head ?>

<?php // drop Google Analytics Here ?>
<?php // end analytics ?>

</head>

<body <?php body_class(); ?>>

<header class="o-header">

<a href="<?php echo site_url(""); ?>" rel="nofollow" class="o-logo">
  <img src="<?php echo get_template_directory_uri(); ?>/library/images/logo_photogether.png" alt="Photogether Logo" class="o-logo__image" />
  <strong class="o-logo__title">
    <?php bloginfo('name'); ?>
  </strong>
</a>

<?php // if you'd like to use the site description you can un-comment it below ?>
<?php // bloginfo('description'); ?>

<nav class="o-nav" role="navigation">
  <?php wp_nav_menu(array(
  'container' => false,                           // remove nav container
  'menu_class' => 'o-nav__list',
  'theme_location' => 'main-nav',                 // where it's located in the theme
  'before' => '',                                 // before the menu
  'after' => '',                                  // after the menu
  'link_before' => '',                            // before each link
  'link_after' => '',                             // after each link
  'depth' => 0,                                   // limit the depth of the nav
  'fallback_cb' => ''                             // fallback function (if there is one)
  )); ?>
</nav>

</header>

<main class="l-container">
<div class="l-wrap">