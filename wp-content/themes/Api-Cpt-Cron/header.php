<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header class="site-header">
        <?php 

        $menuHeader = wp_get_nav_menu_items('menu-1');
        foreach($menuHeader as $menu){
        ?>
        <li class="scroll-to-section "><a href="<?= $menu->url?>"><?= $menu->title ?></a></li>
        <?php
        }

        ?>
    </header>
