<?php
$post_id = get_the_ID();
$prefix  = 'section_hero_1_';

$titulo_main   = get_post_meta( $post_id, $prefix . 'titulo_main',   true );
$titulo_italic = get_post_meta( $post_id, $prefix . 'titulo_italic', true );
$cta_texto     = get_post_meta( $post_id, $prefix . 'cta_texto',     true );
$cta_url       = get_post_meta( $post_id, $prefix . 'cta_url',       true );
$descripcion   = get_post_meta( $post_id, $prefix . 'descripcion',   true );
$video_type     = get_post_meta( $post_id, $prefix . 'video_type',    true ) ?: 'youtube';
$video_url      = get_post_meta( $post_id, $prefix . 'video_id',      true );
$video_controls = get_post_meta( $post_id, $prefix . 'video_controls', true ) ?: '1';

// Extraer el ID del embed a partir de la URL completa
$video_id = $video_url;
if ( $video_type === 'youtube' ) {
    preg_match( '/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video_url, $m );
    $video_id = $m[1] ?? $video_url;
} elseif ( $video_type === 'vimeo' ) {
    preg_match( '/vimeo\.com\/(\d+)/', $video_url, $m );
    $video_id = $m[1] ?? $video_url;
}
$video_portada = get_post_meta( $post_id, $prefix . 'video_portada', true );

$imgs        = get_post_meta( $post_id, $prefix . 'imagenes_group', true );
$img_desktop = $imgs[0]['img_desktop'] ?? '';
$img_tablet  = $imgs[0]['img_tablet']  ?? '';
$img_mobile  = $imgs[0]['img_mobile']  ?? $img_desktop;
?>
<section class="section_hero_1">

    <picture class="hero_1_bg">
        <?php if ( $img_desktop ) : ?>
            <source media="(min-width: 1024px)" srcset="<?php echo esc_url( $img_desktop ); ?>">
        <?php endif; ?>
        <?php if ( $img_tablet ) : ?>
            <source media="(min-width: 768px)" srcset="<?php echo esc_url( $img_tablet ); ?>">
        <?php endif; ?>
        <img src="<?php echo esc_url( $img_mobile ); ?>"
             alt="<?php echo esc_attr( $titulo_main . ' ' . $titulo_italic ); ?>"
             width="1920" height="900"
             loading="eager"
             fetchpriority="high"
             decoding="sync">
    </picture>

    <div class="section_width_hero_1">

        <div class="hero_1_left">
            <?php if ( $titulo_main || $titulo_italic ) : ?>
            <h1>
                <?php if ( $titulo_main ) : ?>
                    <span class="hero_1_title_main"><?php echo esc_html( $titulo_main ); ?></span>
                <?php endif; ?>
                <?php if ( $titulo_italic ) : ?>
                    <span class="hero_1_title_italic"><?php echo esc_html( $titulo_italic ); ?></span>
                <?php endif; ?>
            </h1>
            <?php endif; ?>

            <?php if ( $cta_texto && $cta_url ) : ?>
                <a href="<?php echo esc_url( $cta_url ); ?>" class="hero_1_cta">
                    <?php echo esc_html( $cta_texto ); ?>
                </a>
            <?php endif; ?>
        </div>

        <?php if ( $video_portada || $video_id ) : ?>
        <div class="hero_1_right">
            <div class="hero_1_video_wrap"
                 <?php if ( $video_id ) : ?>
                 data-type-video="<?php echo esc_attr( $video_type ); ?>"
                 data-id-video="<?php echo esc_attr( $video_id ); ?>"
                 data-controls="<?php echo esc_attr( $video_controls ); ?>"
                 <?php endif; ?>>
                <?php if ( $video_portada ) : ?>
                <figure>
                    <img src="<?php echo esc_url( $video_portada ); ?>"
                         alt="<?php echo esc_attr( $titulo_main . ' ' . $titulo_italic ); ?>"
                         width="640" height="360"
                         loading="lazy"
                         decoding="async">
                </figure>
                <?php endif; ?>
                <?php if ( $video_id ) : ?>
                <button class="hero_1_play_btn" type="button" aria-label="Reproducir vídeo">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="44" height="44" aria-hidden="true">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                </button>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if ( $descripcion ) : ?>
            <p class="hero_1_description"><?php echo esc_html( $descripcion ); ?></p>
        <?php endif; ?>

    </div><!-- .section_width_hero_1 -->

</section><!-- .section_hero_1 -->
