<?php
function section_about_1_register_metabox() {
    $cmb = new_cmb2_box([
        'id'           => 'section_about_1_metabox',
        'title'        => 'Section About 1 — Presentación',
        'object_types' => ['page'],
        'show_on'      => ['key' => 'page-template', 'value' => 'page-mieles.php'],
        'closed'       => true,
        'priority'     => 'low',
    ]);

    $prefix = 'section_about_1_';

    $cmb->add_field([
        'name'       => 'Etiqueta superior',
        'id'         => $prefix . 'label',
        'type'       => 'text',
        'attributes' => ['placeholder' => 'Ej: Conexión y Comunidad'],
    ]);

    $cmb->add_field([
        'name'    => 'Título (H1)',
        'id'      => $prefix . 'titulo',
        'type'    => 'text',
        'default' => 'Cosechando Conversaciones con Cuidado',
    ]);

    $cmb->add_field([
        'name'    => 'Descripción',
        'id'      => $prefix . 'desc',
        'type'    => 'wysiwyg',
        'options' => [
            'textarea_rows' => 5,
            'media_buttons' => false,
        ],
    ]);

    $cmb->add_field([
        'name'    => 'Imagen — Mobile',
        'id'      => $prefix . 'img_mobile',
        'type'    => 'file',
        'desc'    => 'Se usa en móvil (y en tablet/desktop si no se sube otra).',
        'options' => ['url' => false],
    ]);

    $cmb->add_field([
        'name'    => 'Imagen — Tablet (≥768px)',
        'id'      => $prefix . 'img_tablet',
        'type'    => 'file',
        'options' => ['url' => false],
    ]);

    $cmb->add_field([
        'name'    => 'Imagen — Desktop (≥1024px)',
        'id'      => $prefix . 'img_desktop',
        'type'    => 'file',
        'options' => ['url' => false],
    ]);
}
add_action('cmb2_admin_init', 'section_about_1_register_metabox');
