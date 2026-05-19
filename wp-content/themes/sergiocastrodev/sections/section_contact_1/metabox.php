<?php
function section_contact_1_register_metabox() {
    $cmb = new_cmb2_box([
        'id'           => 'section_contact_1_metabox',
        'title'        => 'Section Contact 1 — Contacto',
        'object_types' => ['page'],
        'show_on'      => ['key' => 'page-template', 'value' => 'page-mieles.php'],
        'closed'       => true,
        'priority'     => 'low',
    ]);

    $prefix = 'section_contact_1_';

    $cmb->add_field([
        'name'       => 'Título',
        'id'         => $prefix . 'titulo',
        'type'       => 'text',
        'attributes' => ['placeholder' => 'Nuestro Apiario'],
    ]);

    $cmb->add_field([
        'name'       => 'Descripción',
        'id'         => $prefix . 'desc',
        'type'       => 'textarea_small',
        'attributes' => ['placeholder' => 'El corazón de nuestra operación está enclavado...'],
    ]);

    $group_id = $cmb->add_field([
        'name'       => 'Datos de contacto',
        'id'         => $prefix . 'items',
        'type'       => 'group',
        'repeatable' => true,
        'options'    => [
            'group_title'   => 'Item {#}',
            'add_button'    => 'Añadir item',
            'remove_button' => 'Eliminar item',
        ],
    ]);

    $cmb->add_group_field($group_id, [
        'name'    => 'Icono',
        'id'      => 'icon',
        'type'    => 'select',
        'options' => [
            'location' => 'Ubicación (pin)',
            'phone'    => 'Teléfono',
            'email'    => 'Email',
        ],
    ]);

    $cmb->add_group_field($group_id, [
        'name'       => 'Etiqueta',
        'id'         => 'label',
        'type'       => 'text',
        'attributes' => ['placeholder' => 'Ej: Ubicación'],
    ]);

    $cmb->add_group_field($group_id, [
        'name'       => 'Valor',
        'id'         => 'value',
        'type'       => 'textarea_small',
        'desc'       => 'Usa saltos de línea para separar líneas (ej: dirección en dos líneas).',
        'attributes' => ['placeholder' => 'Ej: 13700 Tomelloso, Ciudad Real'],
    ]);

    $cmb->add_field([
        'name'    => 'Shortcode del formulario (CF7)',
        'id'      => $prefix . 'shortcode',
        'type'    => 'text',
        'desc'    => 'Pega aquí el shortcode de Contact Form 7.',
        'attributes' => ['placeholder' => '[contact-form-7 id="xxxx" title="Formulario"]'],
    ]);
}
add_action('cmb2_admin_init', 'section_contact_1_register_metabox');
