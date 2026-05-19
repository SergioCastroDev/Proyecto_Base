<?php
$post_id = get_the_ID();
$prefix  = 'section_about_1_';

$label    = get_post_meta($post_id, $prefix . 'label',   true) ?: 'Conexión y Comunidad';
$titulo   = get_post_meta($post_id, $prefix . 'titulo',  true) ?: 'Cosechando Conversaciones con Cuidado';
$desc     = get_post_meta($post_id, $prefix . 'desc',    true) ?: '<p>Ya sea que busque abastecer su despensa con nuestra miel de flores silvestres o desee programar una visita a nuestro apiario en el bosque de montaña, estamos aquí para darle la bienvenida a nuestra colmena.</p>';
$img_mobile  = get_post_meta($post_id, $prefix . 'img_mobile',  true);
$img_tablet  = get_post_meta($post_id, $prefix . 'img_tablet',  true);
$img_desktop = get_post_meta($post_id, $prefix . 'img_desktop', true);
$img_src     = $img_mobile ?: $img_tablet ?: $img_desktop;
?>
<section class="section_about_1">

    <div class="section_width_about_1">

        <div class="about_1_content">
            <?php if ($label) : ?>
            <span class="about_1_label"><?php echo esc_html($label); ?></span>
            <?php endif; ?>
            <h1 class="about_1_titulo"><?php echo esc_html($titulo); ?></h1>
            <div class="about_1_desc"><?php echo wp_kses_post($desc); ?></div>
        </div>

        <?php if ($img_src) : ?>
        <picture class="about_1_figure">
            <?php if ($img_desktop) : ?>
            <source media="(min-width: 1024px)" srcset="<?php echo esc_url($img_desktop); ?>">
            <?php endif; ?>
            <?php if ($img_tablet) : ?>
            <source media="(min-width: 768px)" srcset="<?php echo esc_url($img_tablet); ?>">
            <?php endif; ?>
            <img src="<?php echo esc_url($img_src); ?>"
                 alt="<?php echo esc_attr($titulo); ?>"
                 width="600"
                 height="800"
                 loading="lazy"
                 decoding="async">
        </picture>
        <?php endif; ?>

    </div>

</section>
