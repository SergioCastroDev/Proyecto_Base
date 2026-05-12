<?php
$post_id    = get_the_ID();
$prefix     = 'section_about_me_';
$caption    = get_post_meta($post_id, $prefix . 'caption', true);
$titulo     = get_post_meta($post_id, $prefix . 'titulo', true);
$descripcion = get_post_meta($post_id, $prefix . 'descripcion', true);
$cta_texto  = get_post_meta($post_id, $prefix . 'cta_texto', true);
$cta_url    = get_post_meta($post_id, $prefix . 'cta_url', true);
$iframe_url = get_post_meta($post_id, $prefix . 'iframe_url', true);

$imagenes_group_data = get_post_meta($post_id, $prefix . 'imagenes_group', true);
if (is_array($imagenes_group_data) && isset($imagenes_group_data[0])) {
    $img_desktop = isset($imagenes_group_data[0]['img_desktop']) ? $imagenes_group_data[0]['img_desktop'] : '';
    $img_tablet  = isset($imagenes_group_data[0]['img_tablet'])  ? $imagenes_group_data[0]['img_tablet']  : '';
    $img_mobile  = isset($imagenes_group_data[0]['img_mobile'])  ? $imagenes_group_data[0]['img_mobile']  : '';
} else {
    $img_desktop = $img_tablet = $img_mobile = '';
}
?>
<section class="section_sergio_about_me" id="about_me">
    <section class="section_width_sergio_about_me">
        <section class="sergio_info">
            <?php if ($caption): ?>
                <p class="sergio_caption"><?php echo esc_html($caption); ?></p>
            <?php endif; ?>
            <?php if ($titulo): ?>
                <h2><?php echo wp_kses_post($titulo); ?></h2>
            <?php endif; ?>
            <?php if ($descripcion): ?>
                <p><?php echo wp_kses_post($descripcion); ?></p>
            <?php endif; ?>
            <?php if ($cta_texto && $cta_url): ?>
                <a href="<?php echo esc_url($cta_url); ?>" class="cta_contact"><?php echo esc_html($cta_texto); ?>
                    <svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.75 6.56699C0.510854 6.70506 0.428916 7.01085 0.566987 7.25C0.705059 7.48915 1.01085 7.57108 1.25 7.43301L0.75 6.56699ZM10.1432 2.12941C10.2147 1.86268 10.0564 1.58851 9.78966 1.51704L5.443 0.352352C5.17626 0.28088 4.9021 0.439172 4.83062 0.705905C4.75915 0.972638 4.91745 1.24681 5.18418 1.31828L9.04788 2.35355L8.01261 6.21726C7.94113 6.48399 8.09943 6.75816 8.36616 6.82963C8.63289 6.9011 8.90706 6.74281 8.97853 6.47608L10.1432 2.12941ZM1 7L1.25 7.43301L9.91025 2.43301L9.66025 2L9.41025 1.56699L0.75 6.56699L1 7Z" fill="#1A1A1A"/></svg>
                </a>
            <?php endif; ?>
        </section>
        <picture>
            <?php if ($img_desktop): ?>
                <source media="(min-width: 1024px)" srcset="<?php echo esc_url($img_desktop); ?>">
            <?php endif; ?>
            <?php if ($img_tablet): ?>
                <source media="(min-width: 768px)" srcset="<?php echo esc_url($img_tablet); ?>">
            <?php endif; ?>
            <img src="<?php echo esc_url($img_mobile ?: $img_desktop); ?>" alt="about me sergio">
            <?php if ($iframe_url): ?>
                <div>
                    <iframe src="<?php echo esc_url($iframe_url); ?>" title="Iframe de web de Sergio Castro en desktop"></iframe>
                </div>
            <?php endif; ?>
            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" id="Layer_1" x="0" y="0" viewBox="0 0 32 32"><path d="M25 21c0 5-4 9-9 9-4.9 0-9-4-9-9V11c0-4.9 4.1-9 9-9 5 0 9 4.1 9 9z" style="fill:none;stroke:#fff;stroke-width:2;stroke-miterlimit:10"></path><path d="M16 8v6" style="fill:none;stroke:#fff;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10"></path></svg>
        </picture>
    </section>
</section>
