<?php
function section_cta_1_register_metabox() {
    $cmb = new_cmb2_box([
        'id'           => 'section_cta_1_metabox',
        'title'        => 'Section CTA 1 — ¿Más info?',
        'object_types' => ['page'],
        'show_on'      => ['key' => 'page-template', 'value' => 'page-mieles.php'],
        'closed'       => true,
        'priority'     => 'low',
    ]);

    $prefix = 'section_cta_1_';

    $cmb->add_field([
        'name'    => 'Imagen de fondo — Mobile',
        'id'      => $prefix . 'bg_mobile',
        'type'    => 'file',
        'desc'    => 'Opcional. Se usa en móvil (y en tablet/desktop si no se sube otra).',
        'options' => ['url' => false],
    ]);

    $cmb->add_field([
        'name'    => 'Imagen de fondo — Tablet (≥768px)',
        'id'      => $prefix . 'bg_tablet',
        'type'    => 'file',
        'options' => ['url' => false],
    ]);

    $cmb->add_field([
        'name'    => 'Imagen de fondo — Desktop (≥1024px)',
        'id'      => $prefix . 'bg_desktop',
        'type'    => 'file',
        'options' => ['url' => false],
    ]);

    $cmb->add_field([
        'name'    => 'Título',
        'id'      => $prefix . 'titulo',
        'type'    => 'text',
        'default' => '¿Más info?',
    ]);

    $cmb->add_field([
        'name'    => 'Subtítulo (itálica)',
        'id'      => $prefix . 'subtitulo',
        'type'    => 'text',
        'default' => 'Agenda una visita o llamada con nuestro equipo comercial',
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
        'name'    => 'Texto del botón',
        'id'      => $prefix . 'btn_text',
        'type'    => 'text',
        'default' => 'Contactar',
    ]);

    $cmb->add_field([
        'name' => 'URL del botón',
        'id'   => $prefix . 'btn_url',
        'type' => 'text_url',
        'desc' => 'Ej: #contacto o https://...',
    ]);
}
add_action('cmb2_admin_init', 'section_cta_1_register_metabox');
