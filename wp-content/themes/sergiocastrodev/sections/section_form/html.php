<?php
$post_id        = get_the_ID();
$prefix         = 'section_form_';
$icono_animado  = get_post_meta($post_id, $prefix . 'icono_animado', true);
$icono_estatico = get_post_meta($post_id, $prefix . 'icono_estatico', true);
$caption        = get_post_meta($post_id, $prefix . 'caption', true);
$titulo         = get_post_meta($post_id, $prefix . 'titulo', true);
$shortcode      = get_post_meta($post_id, $prefix . 'shortcode', true);

$imagenes_group_data = get_post_meta($post_id, $prefix . 'imagenes_group', true);
if (is_array($imagenes_group_data) && isset($imagenes_group_data[0])) {
    $img_desktop = isset($imagenes_group_data[0]['img_desktop']) ? $imagenes_group_data[0]['img_desktop'] : '';
    $img_tablet  = isset($imagenes_group_data[0]['img_tablet'])  ? $imagenes_group_data[0]['img_tablet']  : '';
    $img_mobile  = isset($imagenes_group_data[0]['img_mobile'])  ? $imagenes_group_data[0]['img_mobile']  : '';
} else {
    $img_desktop = $img_tablet = $img_mobile = '';
}
?>
<section class="section_sergio_form" id="contact">
    <section class="section_width_sergio_form">
        <?php if ($icono_animado || $icono_estatico): ?>
            <span class="sergio_icon">
                <?php echo $icono_animado; ?>
                <?php echo $icono_estatico; ?>
            </span>
        <?php endif; ?>
        <div class="sergio_info">
            <?php if ($caption): ?>
                <p class="sergio_caption"><?php echo esc_html($caption); ?></p>
            <?php endif; ?>
            <?php if ($titulo): ?>
                <h2><?php echo wp_kses_post($titulo); ?></h2>
            <?php endif; ?>
        </div>
        <div class="sergio_form_container">
            <picture>
                <?php if ($img_desktop): ?>
                    <source media="(min-width: 1024px)" srcset="<?php echo esc_url($img_desktop); ?>">
                <?php endif; ?>
                <?php if ($img_tablet): ?>
                    <source media="(min-width: 768px)" srcset="<?php echo esc_url($img_tablet); ?>">
                <?php endif; ?>
                <?php if ($img_mobile || $img_desktop): ?>
                    <img src="<?php echo esc_url($img_mobile ?: $img_desktop); ?>" alt="Formulario de contacto">
                <?php endif; ?>
            </picture>
            <?php if ($shortcode): ?>
                <?php echo do_shortcode($shortcode); ?>
            <?php endif; ?>
        </div>
    </section>
</section>
