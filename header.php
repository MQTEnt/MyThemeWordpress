<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); /**/ ?>" />
        <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
        <div id="container">
              <header id="header">
                   <?php tmq_header(); ?>
                   <?php tmq_menu('primary-menu'); ?>
              </header>