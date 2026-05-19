<?php
$post_id = get_the_ID();
$prefix  = 'section_cta_1_';

$bg_mobile  = get_post_meta($post_id, $prefix . 'bg_mobile',  true);
$bg_tablet  = get_post_meta($post_id, $prefix . 'bg_tablet',  true);
$bg_desktop = get_post_meta($post_id, $prefix . 'bg_desktop', true);
$has_bg     = $bg_mobile || $bg_tablet || $bg_desktop;

$titulo    = get_post_meta($post_id, $prefix . 'titulo',    true) ?: '¿Más info?';
$subtitulo = get_post_meta($post_id, $prefix . 'subtitulo', true) ?: 'Agenda una visita o llamada con nuestro equipo comercial';
$desc      = get_post_meta($post_id, $prefix . 'desc',      true) ?: '<p>Más de 3000 productos disponibles a una llamada de distancia. Nuestros expertos están listos para asesorarte en tu selección.</p>';
$btn_text  = get_post_meta($post_id, $prefix . 'btn_text',  true) ?: 'Contactar';
$btn_url   = get_post_meta($post_id, $prefix . 'btn_url',   true) ?: '#';
?>
<?php if ($has_bg) : ?>
<style>
.section_cta_1 {
    <?php if ($bg_mobile) : ?>background-image: url('<?php echo esc_url($bg_mobile); ?>');<?php endif; ?>
}
<?php if ($bg_tablet) : ?>
@media (min-width: 768px) {
    .section_cta_1 { background-image: url('<?php echo esc_url($bg_tablet); ?>'); }
}
<?php endif; ?>
<?php if ($bg_desktop) : ?>
@media (min-width: 1024px) {
    .section_cta_1 { background-image: url('<?php echo esc_url($bg_desktop); ?>'); }
}
<?php endif; ?>
</style>
<?php endif; ?>
<section class="section_cta_1<?php echo $has_bg ? ' has-bg' : ''; ?>">

    <div class="section_width_cta_1">

        <div class="cta_1_card">
            <h2 class="cta_1_titulo"><?php echo esc_html($titulo); ?></h2>
            <p class="cta_1_subtitulo"><?php echo esc_html($subtitulo); ?></p>
            <div class="cta_1_desc"><?php echo wp_kses_post($desc); ?></div>
            <a class="cta_1_btn" href="<?php echo esc_url($btn_url); ?>">
                <?php echo esc_html($btn_text); ?>
            </a>
        </div>

    </div>

</section>
