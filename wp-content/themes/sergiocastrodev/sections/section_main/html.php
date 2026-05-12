<?php
$post_id        = get_the_ID();
$prefix         = 'section_main_';
$titulo         = get_post_meta($post_id, $prefix . 'titulo', true);
$descripcion    = get_post_meta($post_id, $prefix . 'descripcion', true);
$subtitulo      = get_post_meta($post_id, $prefix . 'subtitulo', true);
$cta_texto      = get_post_meta($post_id, $prefix . 'cta_texto', true);
$cta_url        = get_post_meta($post_id, $prefix . 'cta_url', true);
$icono_animado  = get_post_meta($post_id, $prefix . 'icono_animado', true);
$icono_estatico = get_post_meta($post_id, $prefix . 'icono_estatico', true);

$imagenes_group_data = get_post_meta($post_id, $prefix . 'imagenes_group', true);
if (is_array($imagenes_group_data) && isset($imagenes_group_data[0])) {
    $img_desktop = isset($imagenes_group_data[0]['img_desktop']) ? $imagenes_group_data[0]['img_desktop'] : '';
    $img_tablet  = isset($imagenes_group_data[0]['img_tablet'])  ? $imagenes_group_data[0]['img_tablet']  : '';
    $img_mobile  = isset($imagenes_group_data[0]['img_mobile'])  ? $imagenes_group_data[0]['img_mobile']  : '';
} else {
    $img_desktop = $img_tablet = $img_mobile = '';
}
?>
<section class="section_sergio_main">
    <section class="section_width_sergio_main">
        <div class="container_title">
            <h1><?php if ($titulo) { echo wp_kses_post($titulo); } ?></h1>
            <p><?php if ($descripcion) { echo wp_kses_post($descripcion); } ?></p>
            <h2><?php if ($subtitulo) { echo wp_kses_post($subtitulo); } ?></h2>
            <?php if ($cta_texto && $cta_url): ?>
                <a href="<?php echo esc_url($cta_url); ?>" class="cta_contact"><?php echo esc_html($cta_texto); ?>
                    <svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.75 6.56699C0.510854 6.70506 0.428916 7.01085 0.566987 7.25C0.705059 7.48915 1.01085 7.57108 1.25 7.43301L0.75 6.56699ZM10.1432 2.12941C10.2147 1.86268 10.0564 1.58851 9.78966 1.51704L5.443 0.352352C5.17626 0.28088 4.9021 0.439172 4.83062 0.705905C4.75915 0.972638 4.91745 1.24681 5.18418 1.31828L9.04788 2.35355L8.01261 6.21726C7.94113 6.48399 8.09943 6.75816 8.36616 6.82963C8.63289 6.9011 8.90706 6.74281 8.97853 6.47608L10.1432 2.12941ZM1 7L1.25 7.43301L9.91025 2.43301L9.66025 2L9.41025 1.56699L0.75 6.56699L1 7Z" fill="#1A1A1A"/></svg>
                </a>
            <?php endif; ?>
        </div>
        <picture>
            <source media="(1024px)" srcset="<?php echo esc_url($img_desktop); ?>">
            <source media="(min-width: 768px)" srcset="<?php echo esc_url($img_tablet); ?>">
            <img src="<?php echo esc_url($img_mobile); ?>" alt="frontend sergio">
        </picture>
        <span class="sergio_icon">
            <?php echo $icono_animado; ?>
            <?php echo $icono_estatico; ?>
        </span>
    </section>
</section>
