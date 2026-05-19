<?php
$post_id   = get_the_ID();
$prefix    = 'section_contact_1_';

$titulo    = get_post_meta($post_id, $prefix . 'titulo',    true) ?: 'Nuestro Apiario';
$desc      = get_post_meta($post_id, $prefix . 'desc',      true) ?: 'El corazón de nuestra operación está enclavado en las estribaciones, donde el aire es fresco y las abejas deambulan libres.';
$items     = get_post_meta($post_id, $prefix . 'items',     true);
$shortcode = get_post_meta($post_id, $prefix . 'shortcode', true) ?: '[contact-form-7 id="2970566" title="Formulario de contacto 1"]';

if (empty($items) || !is_array($items)) {
    $items = [
        ['icon' => 'location', 'label' => 'Ubicación',          'value' => "13700 Tomelloso, Ciudad Real\nCalle Nueva, 23"],
        ['icon' => 'phone',    'label' => 'Teléfono',           'value' => '+34 926 123 456'],
        ['icon' => 'email',    'label' => 'Correo Electrónico', 'value' => 'hola@mielesmontes.com'],
    ];
}

$svg_icons = [
    'location' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
    'phone'    => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.36 11.43 19.79 19.79 0 0 1 1.27 2.77 2 2 0 0 1 3.26.99h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.09 8.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21 16.92z"/></svg>',
    'email'    => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>',
];
?>
<section class="section_contact_1" id="contacto">

    <div class="section_width_contact_1">

        <div class="contact_1_info">
            <h2 class="contact_1_titulo"><?php echo esc_html($titulo); ?></h2>
            <p class="contact_1_desc"><?php echo esc_html($desc); ?></p>

            <?php if (!empty($items)) : ?>
            <ul class="contact_1_items">
                <?php foreach ($items as $item) :
                    $icon_key = isset($item['icon']) ? $item['icon'] : 'location';
                    $label    = isset($item['label']) ? esc_html($item['label']) : '';
                    $value    = isset($item['value']) ? esc_html($item['value']) : '';
                    $svg      = isset($svg_icons[$icon_key]) ? $svg_icons[$icon_key] : $svg_icons['location'];
                ?>
                <li class="contact_1_item">
                    <div class="contact_1_icon"><?php echo $svg; ?></div>
                    <div class="contact_1_item_text">
                        <span class="contact_1_item_label"><?php echo $label; ?></span>
                        <span class="contact_1_item_value"><?php echo $value; ?></span>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>

        <div class="contact_1_form_card">
            <?php echo do_shortcode($shortcode); ?>
        </div>

    </div>

</section>
