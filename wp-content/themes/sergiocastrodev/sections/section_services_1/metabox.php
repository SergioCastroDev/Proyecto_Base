<?php
function section_services_1_register_metabox() {
    $cmb = new_cmb2_box([
        'id'           => 'section_services_1_metabox',
        'title'        => 'Section Services 1',
        'object_types' => ['page'],
        'show_on'      => ['key' => 'page-template', 'value' => 'page-mieles.php'],
        'closed'       => true,
        'priority'     => 'low',
    ]);

    $prefix = 'section_services_1_';

    $cmb->add_field([
        'name' => 'Titular — acento (italic)',
        'id'   => $prefix . 'headline_accent',
        'type' => 'text',
        'desc' => 'Texto en cursiva al inicio del titular. Ej: "120 hectáreas"',
    ]);

    $cmb->add_field([
        'name' => 'Titular — resto',
        'id'   => $prefix . 'headline',
        'type' => 'text',
        'desc' => 'Continuación del titular tras el acento. Ej: "de colmenas prístinas dedicadas a la apicultura sostenible."',
    ]);

    $cmb->add_field([
        'name' => 'Cita',
        'id'   => $prefix . 'quote',
        'type' => 'textarea_small',
    ]);

    // ── Tarjetas (repeatable) ──────────────────────────────────────────────────
    $cards = $cmb->add_field([
        'id'         => $prefix . 'cards',
        'type'       => 'group',
        'repeatable' => true,
        'options'    => [
            'group_title'   => 'Tarjeta {#}',
            'add_button'    => 'Añadir tarjeta',
            'remove_button' => 'Eliminar tarjeta',
            'sortable'      => true,
        ],
    ]);

    $cmb->add_group_field($cards, [
        'name'              => 'Icono SVG',
        'id'                => 'icon_svg',
        'type'              => 'textarea_small',
        'desc'              => 'Pega aquí el código SVG completo (sin estilos inline de color, usa currentColor).',
        'sanitization_cb'   => false,
        'escape_cb'         => false,
    ]);

    $cmb->add_group_field($cards, [
        'name' => 'Título',
        'id'   => 'title',
        'type' => 'text',
    ]);

    $cmb->add_group_field($cards, [
        'name' => 'Descripción',
        'id'   => 'desc',
        'type' => 'textarea_small',
    ]);

    $cmb->add_group_field($cards, [
        'name' => 'Enlace URL (opcional)',
        'id'   => 'link_url',
        'type' => 'text_url',
    ]);

    $cmb->add_group_field($cards, [
        'name' => 'Texto del enlace (opcional)',
        'id'   => 'link_text',
        'type' => 'text',
        'desc' => 'Si se deja vacío y hay URL, se mostrará "Ver más".',
    ]);
}
add_action('cmb2_admin_init', 'section_services_1_register_metabox');
