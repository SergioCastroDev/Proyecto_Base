<?php

add_action( 'cmb2_admin_init', 'section_form_register_metabox' );
function section_form_register_metabox() {
	$prefix = 'section_form_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Bloque Section Form', 'cmb2' ),
		'object_types' => array( 'page' ),
		'show_on'      => array(
			'key'   => 'page-template',
			'value' => 'page-home.php',
		),
		'closed'       => true,
	) );

	$cmb->add_field( array(
		'name'            => __( 'Icono con animación (SVG)', 'cmb2' ),
		'id'              => $prefix . 'icono_animado',
		'type'            => 'textarea',
		'desc'            => __( 'Pega el código SVG del icono que tiene animación.', 'cmb2' ),
		'sanitization_cb' => false,
		'escape_cb'       => false,
	) );

	$cmb->add_field( array(
		'name'            => __( 'Icono sin animación (SVG)', 'cmb2' ),
		'id'              => $prefix . 'icono_estatico',
		'type'            => 'textarea',
		'desc'            => __( 'Pega el código SVG del icono estático.', 'cmb2' ),
		'sanitization_cb' => false,
		'escape_cb'       => false,
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
		'name' => __( 'Shortcode del formulario', 'cmb2' ),
		'id'   => $prefix . 'shortcode',
		'type' => 'text',
		'desc' => __( 'Ej: [contact-form-7 id="abc123" title="Formulario de contacto 1"]', 'cmb2' ),
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
