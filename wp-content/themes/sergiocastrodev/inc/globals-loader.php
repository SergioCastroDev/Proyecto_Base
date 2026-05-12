<?php
add_action('cmb2_admin_init', 'sergiocastrodev_register_globals_page');
function sergiocastrodev_register_globals_page() {
    $cmb = new_cmb2_box([
        'id'           => 'globals_options',
        'title'        => 'Globales',
        'object_types' => ['options-page'],
        'option_key'   => 'globals_options',
        'parent_slug'  => 'options-general.php',
        'capability'   => 'manage_options',
    ]);

    $base = get_template_directory() . '/templates/';
    foreach (['header', 'footer'] as $part) {
        $globals_file = $base . $part . '/globals.php';
        if (file_exists($globals_file)) {
            require $globals_file;
        }
    }
}
