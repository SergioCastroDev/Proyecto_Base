<?php
// $cmb disponible desde globals-loader.php
$cmb->add_field([
    'name' => 'Footer',
    'id'   => 'globals_footer_sep',
    'type' => 'title',
]);
$cmb->add_field([
    'name' => 'Texto CTA',
    'id'   => 'footer_cta_texto',
    'type' => 'text',
]);
$cmb->add_field([
    'name' => 'URL CTA',
    'id'   => 'footer_cta_url',
    'type' => 'text_url',
]);
$cmb->add_field([
    'name' => 'URL LinkedIn',
    'id'   => 'footer_linkedin_url',
    'type' => 'text_url',
]);
$cmb->add_field([
    'name' => 'URL YouTube',
    'id'   => 'footer_youtube_url',
    'type' => 'text_url',
]);
$cmb->add_field([
    'name' => 'Email de contacto',
    'id'   => 'footer_email',
    'type' => 'text',
]);
$cmb->add_field([
    'name' => 'Logo — código SVG',
    'id'   => 'footer_logo_svg',
    'type' => 'textarea',
    'desc' => 'Pega aquí el código SVG para inyectarlo inline. Si se rellena, tiene prioridad sobre la imagen.',
]);
$cmb->add_field([
    'name' => 'Logo — imagen',
    'id'   => 'footer_logo',
    'type' => 'file',
    'desc' => 'Sube una imagen si no usas SVG inline.',
]);
$cmb->add_field([
    'name' => 'URL sitio (logo)',
    'id'   => 'footer_site_url',
    'type' => 'text_url',
]);
$cmb->add_field([
    'name' => 'Texto copyright',
    'id'   => 'footer_copyright',
    'type' => 'text',
]);
