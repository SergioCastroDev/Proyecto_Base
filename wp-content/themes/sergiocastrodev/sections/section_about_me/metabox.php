<?php

add_action( 'cmb2_admin_init', 'section_about_me_register_metabox' );
function section_about_me_register_metabox() {
	$prefix = 'section_about_me_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Bloque Section About Me', 'cmb2' ),
		'object_types' => array( 'page' ),
		'show_on'      => array(
			'key'   => 'page-template',
			'value' => 'page-home.php',
		),
		'closed'       => true,
	) );

	$cmb->add_field( array(
		'name' => __( 'Caption', 'cmb2' ),
		'id'   => $prefix . 'caption',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Título', 'cmb2' ),
		'id'   => $prefix . 'titulo',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Descripción', 'cmb2' ),
		'id'   => $prefix . 'descripcion',
		'type' => 'textarea',
	) );

	$cmb->add_field( array(
		'name' => __( 'Texto del CTA', 'cmb2' ),
		'id'   => $prefix . 'cta_texto',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'URL del CTA', 'cmb2' ),
		'id'   => $prefix . 'cta_url',
		'type' => 'text_url',
	) );

	$cmb->add_field( array(
		'name' => __( 'URL del Iframe', 'cmb2' ),
		'id'   => $prefix . 'iframe_url',
		'type' => 'text_url',
	) );

	$group_field_id = $cmb->add_field( array(
		'id'          => $prefix . 'imagenes_group',
		'type'        => 'group',
		'description' => __( 'Imágenes por resolución', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Imágenes', 'cmb2' ),
			'add_button'    => false,
			'remove_button' => false,
			'sortable'      => false,
			'closed'        => true,
		),
		'repeatable'  => false,
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __( 'Desktop', 'cmb2' ),
		'id'   => 'img_desktop',
		'type' => 'file',
	) );
	$cmb->add_group_field( $group_field_id, array(
		'name' => __( 'Tablet', 'cmb2' ),
		'id'   => 'img_tablet',
		'type' => 'file',
	) );
	$cmb->add_group_field( $group_field_id, array(
		'name' => __( 'Mobile', 'cmb2' ),
		'id'   => 'img_mobile',
		'type' => 'file',
	) );
}
