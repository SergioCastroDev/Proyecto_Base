<?php
function section_products_1_register_metabox() {
    $cmb = new_cmb2_box([
        'id'           => 'section_products_1_metabox',
        'title'        => 'Section Products 1 — Nuestros Productos',
        'object_types' => ['page'],
        'show_on'      => ['key' => 'page-template', 'value' => 'page-mieles.php'],
        'closed'       => true,
        'priority'     => 'low',
    ]);

    $prefix = 'section_products_1_';

    $cmb->add_field([
        'name'    => 'Título de la sección',
        'id'      => $prefix . 'titulo',
        'type'    => 'text',
        'default' => 'Nuestros Productos',
    ]);

    $cmb->add_field([
        'name'    => 'Subtítulo',
        'id'      => $prefix . 'subtitulo',
        'type'    => 'textarea_small',
        'default' => 'Miel artesanal cruda, cosechada con respeto por la naturaleza. Cada frasco refleja la esencia floral de nuestro entorno.',
    ]);

    $cmb->add_field([
        'name'       => 'Texto del botón CTA',
        'id'         => $prefix . 'cta_text',
        'type'       => 'text',
        'desc'       => 'Dejar vacío para ocultar el botón.',
        'attributes' => ['placeholder' => 'Ver todos los productos'],
    ]);

    $cmb->add_field([
        'name' => 'URL del botón CTA',
        'id'   => $prefix . 'cta_url',
        'type' => 'text_url',
        'desc' => 'Ej: /tienda o https://...',
    ]);

    // ── Productos (repeatable) ─────────────────────────────────────────────────
    $products = $cmb->add_field([
        'id'         => $prefix . 'products',
        'type'       => 'group',
        'repeatable' => true,
        'options'    => [
            'group_title'   => 'Producto {#}',
            'add_button'    => 'Añadir producto',
            'remove_button' => 'Eliminar producto',
            'sortable'      => true,
        ],
    ]);

    $cmb->add_group_field($products, [
        'name' => 'Imagen',
        'id'   => 'img',
        'type' => 'file',
        'desc' => 'Proporción 4:3 recomendada (mín. 800×600 px).',
    ]);

    $cmb->add_group_field($products, [
        'name' => 'Badge (etiqueta sobre la imagen)',
        'id'   => 'badge',
        'type' => 'text',
        'desc' => 'Ej: Wildflower, Raw Comb, Mountain Forest',
    ]);

    $cmb->add_group_field($products, [
        'name' => 'Nombre del producto',
        'id'   => 'title',
        'type' => 'text',
    ]);

    $cmb->add_group_field($products, [
        'name' => 'Descripción corta',
        'id'   => 'desc',
        'type' => 'textarea_small',
    ]);

    $cmb->add_group_field($products, [
        'name' => 'Precio',
        'id'   => 'price',
        'type' => 'text',
        'desc' => 'Ej: €24.00',
    ]);

    $cmb->add_group_field($products, [
        'name' => 'URL del producto',
        'id'   => 'url',
        'type' => 'text_url',
    ]);
}
add_action('cmb2_admin_init', 'section_products_1_register_metabox');
