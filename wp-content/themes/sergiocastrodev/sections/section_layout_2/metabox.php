<?php
function section_layout_2_register_metabox() {
    $cmb = new_cmb2_box([
        'id'           => 'section_layout_2_metabox',
        'title'        => 'Section Layout 2 — Nuestro Proceso Artesanal',
        'object_types' => ['page'],
        'show_on'      => ['key' => 'page-template', 'value' => 'page-mieles.php'],
        'closed'       => true,
        'priority'     => 'low',
    ]);

    $prefix = 'section_layout_2_';

    $cmb->add_field([
        'name'    => 'Caption (texto pequeño sobre el título)',
        'id'      => $prefix . 'caption',
        'type'    => 'text',
        'default' => 'Tradición & Técnica',
    ]);

    $cmb->add_field([
        'name'    => 'Título de la sección',
        'id'      => $prefix . 'titulo',
        'type'    => 'text',
        'default' => 'Nuestro Proceso Artesanal',
    ]);

    // ── Pasos del proceso (repeatable) ────────────────────────────────────────
    $steps = $cmb->add_field([
        'id'         => $prefix . 'steps',
        'type'       => 'group',
        'repeatable' => true,
        'options'    => [
            'group_title'   => 'Paso {#}',
            'add_button'    => 'Añadir paso',
            'remove_button' => 'Eliminar paso',
            'sortable'      => true,
        ],
    ]);

    $cmb->add_group_field($steps, [
        'name' => 'Imagen',
        'id'   => 'img',
        'type' => 'file',
        'desc' => 'Fotografía del paso. Proporción cuadrada recomendada (mín. 640×640 px).',
    ]);

    $cmb->add_group_field($steps, [
        'name' => 'Título del paso',
        'id'   => 'title',
        'type' => 'text',
    ]);

    $cmb->add_group_field($steps, [
        'name' => 'Descripción',
        'id'   => 'desc',
        'type' => 'textarea_small',
    ]);
}
add_action('cmb2_admin_init', 'section_layout_2_register_metabox');
