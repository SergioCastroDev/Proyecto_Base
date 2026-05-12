<?php
// Cargar estilos y scripts
function sergiocastrodev_enqueue_scripts() {
    wp_enqueue_style('sergiocastrodev-style', get_stylesheet_uri());
    wp_enqueue_style('sergiocastrodev-main', get_template_directory_uri() . '/assets/css/style.css', array(), null);
    wp_enqueue_script('sergiocastrodev-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'sergiocastrodev_enqueue_scripts');


// Registro de ubicaciones de menús
add_action('after_setup_theme', 'sergiocastrodev_register_menus');
function sergiocastrodev_register_menus() {
    register_nav_menus([
        'header_menu' => __('Menú Header', 'sergiocastrodev'),
    ]);
}

// Loader automático de metaboxes de bloques
require_once get_template_directory() . '/inc/metabox-loader.php';

// Loader de opciones globales (header y footer)
require_once get_template_directory() . '/inc/globals-loader.php';

