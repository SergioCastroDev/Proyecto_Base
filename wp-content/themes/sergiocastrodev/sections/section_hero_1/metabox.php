<?php
function section_hero_1_register_metabox() {
    $cmb = new_cmb2_box( [
        'id'           => 'section_hero_1_metabox',
        'title'        => 'Hero 1',
        'object_types' => [ 'page' ],
        'show_on'      => [ 'key' => 'page-template', 'value' => 'page-mieles.php' ],
        'closed'       => true,
        'priority'     => 'low',
    ] );

    $prefix = 'section_hero_1_';

    // ── Imágenes de fondo ──────────────────────────────────
    $img_group = $cmb->add_field( [
        'id'         => $prefix . 'imagenes_group',
        'type'       => 'group',
        'repeatable' => false,
        'options'    => [ 'group_title' => 'Imagen de fondo' ],
    ] );
    $cmb->add_group_field( $img_group, [ 'name' => 'Desktop (≥1024px)', 'id' => 'img_desktop', 'type' => 'file' ] );
    $cmb->add_group_field( $img_group, [ 'name' => 'Tablet (≥768px)',   'id' => 'img_tablet',  'type' => 'file' ] );
    $cmb->add_group_field( $img_group, [ 'name' => 'Mobile',            'id' => 'img_mobile',  'type' => 'file' ] );

    // ── Titular ────────────────────────────────────────────
    $cmb->add_field( [
        'name' => 'Título principal',
        'id'   => $prefix . 'titulo_main',
        'type' => 'text',
    ] );
    $cmb->add_field( [
        'name' => 'Título itálico',
        'id'   => $prefix . 'titulo_italic',
        'type' => 'text',
    ] );

    // ── CTA ────────────────────────────────────────────────
    $cmb->add_field( [
        'name' => 'Texto del botón',
        'id'   => $prefix . 'cta_texto',
        'type' => 'text',
    ] );
    $cmb->add_field( [
        'name' => 'URL del botón',
        'id'   => $prefix . 'cta_url',
        'type' => 'text_url',
    ] );

    // ── Vídeo ──────────────────────────────────────────────
    $cmb->add_field( [
        'name'    => 'Tipo de vídeo',
        'id'      => $prefix . 'video_type',
        'type'    => 'select',
        'options' => [
            'youtube' => 'YouTube',
            'vimeo'   => 'Vimeo',
            'video'   => 'Fichero directo (mp4/webm)',
        ],
    ] );
    $cmb->add_field( [
        'name' => 'URL del vídeo',
        'desc' => 'Pega la URL completa de YouTube, Vimeo o la URL del fichero en Medios.',
        'id'   => $prefix . 'video_id',
        'type' => 'text_url',
    ] );
    $cmb->add_field( [
        'name'    => 'Mostrar controles del reproductor',
        'id'      => $prefix . 'video_controls',
        'type'    => 'select',
        'options' => [
            '1' => 'Sí',
            '0' => 'No',
        ],
    ] );
    $cmb->add_field( [
        'name' => 'Portada del vídeo',
        'id'   => $prefix . 'video_portada',
        'type' => 'file',
    ] );

    // ── Descripción ────────────────────────────────────────
    $cmb->add_field( [
        'name' => 'Descripción',
        'id'   => $prefix . 'descripcion',
        'type' => 'textarea_small',
    ] );
}
add_action( 'cmb2_admin_init', 'section_hero_1_register_metabox' );
