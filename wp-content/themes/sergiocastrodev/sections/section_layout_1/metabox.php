<?php
function section_layout_1_register_metabox() {
    $cmb = new_cmb2_box([
        'id'           => 'section_layout_1_metabox',
        'title'        => 'Section Layout 1 — Nuestra Cosecha',
        'object_types' => ['page'],
        'show_on'      => ['key' => 'page-template', 'value' => 'page-mieles.php'],
        'closed'       => true,
        'priority'     => 'low',
    ]);

    $prefix = 'section_layout_1_';

    $cmb->add_field([
        'name' => 'Título de la sección',
        'id'   => $prefix . 'titulo',
        'type' => 'text',
        'desc' => 'Ej: "Nuestra Cosecha Principal"',
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
        'name' => 'Imagen',
        'id'   => 'img',
        'type' => 'file',
        'desc' => 'Foto de fondo de la tarjeta. Si se deja vacía, se muestra el degradado de fallback.',
    ]);

    $cmb->add_group_field($cards, [
        'name'    => 'Degradado fallback',
        'id'      => 'bg',
        'type'    => 'text',
        'desc'    => 'CSS linear-gradient que se muestra cuando no hay imagen. Ej: linear-gradient(160deg, #8D4B00 0%, #271500 100%)',
        'default' => 'linear-gradient(160deg, #8D4B00 0%, #271500 100%)',
    ]);

    $cmb->add_group_field($cards, [
        'name' => 'Label (sobre el título)',
        'id'   => 'label',
        'type' => 'text',
        'desc' => 'Texto pequeño en mayúsculas. Ej: "El alma de la colmena"',
    ]);

    $cmb->add_group_field($cards, [
        'name' => 'Título de la tarjeta',
        'id'   => 'title',
        'type' => 'text',
    ]);

    $cmb->add_group_field($cards, [
        'name' => 'Descripción',
        'id'   => 'desc',
        'type' => 'textarea_small',
        'desc' => 'Aparece al hacer hover sobre la tarjeta.',
    ]);

    $cmb->add_group_field($cards, [
        'name' => 'Enlace URL',
        'id'   => 'link_url',
        'type' => 'text_url',
        'desc' => 'URL a la que apunta el título de la tarjeta. Si se deja vacío, se usará "#".',
    ]);
}
add_action('cmb2_admin_init', 'section_layout_1_register_metabox');
