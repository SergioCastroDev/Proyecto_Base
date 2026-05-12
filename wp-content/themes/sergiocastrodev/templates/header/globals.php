<?php
// $cmb disponible desde globals-loader.php
$cmb->add_field([
    'name' => 'Header',
    'id'   => 'globals_header_sep',
    'type' => 'title',
]);
$cmb->add_field([
    'name' => 'Logo',
    'id'   => 'header_logo',
    'type' => 'file',
]);
$cmb->add_field([
    'name' => 'URL del Logo',
    'id'   => 'header_logo_url',
    'type' => 'text_url',
]);
