<?php

function add_scripts_and_styles() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
}

add_action ('wp_enqueue_scripts','add_scripts_and_styles');
add_action ('after_setup_theme','add_menu');

function add_menu() {
    register_nav_menu( 'top' , 'Главное меню сайта');
}

?>