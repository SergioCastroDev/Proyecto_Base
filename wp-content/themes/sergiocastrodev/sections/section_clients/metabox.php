<?php

add_action( 'cmb2_admin_init', 'section_clients_register_metabox' );
function section_clients_register_metabox() {
	$prefix = 'section_clients_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Bloque Section Clients', 'cmb2' ),
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

	$group_field_id = $cmb->add_field( array(
		'id'          => $prefix . 'items',
		'type'        => 'group',
		'description' => __( 'Clientes', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Cliente {#}', 'cmb2' ),
			'add_button'    => __( 'Añadir cliente', 'cmb2' ),
			'remove_button' => __( 'Eliminar cliente', 'cmb2' ),
			'sortable'      => true,
			'closed'        => true,
		),
		'repeatable'  => true,
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __( 'Nombre del cliente', 'cmb2' ),
		'id'   => 'nombre',
		'type' => 'text',
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name'            => __( 'Logo — código SVG', 'cmb2' ),
		'id'              => 'logo_svg',
		'type'            => 'textarea_small',
		'desc'            => __( 'Pega el código SVG. Tiene prioridad sobre la imagen.', 'cmb2' ),
		'sanitization_cb' => false,
		'escape_cb'       => false,
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __( 'Logo — imagen', 'cmb2' ),
		'id'   => 'logo_img',
		'type' => 'file',
		'desc' => __( 'Sube una imagen si no usas SVG inline.', 'cmb2' ),
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __( 'URL (opcional)', 'cmb2' ),
		'id'   => 'url',
		'type' => 'text_url',
		'desc' => __( 'Si se rellena, el logo será un enlace.', 'cmb2' ),
	) );
}
