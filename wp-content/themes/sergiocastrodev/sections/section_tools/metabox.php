<?php

add_action( 'cmb2_admin_init', 'section_tools_register_metabox' );
function section_tools_register_metabox() {
	$prefix = 'section_tools_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Bloque Section Tools', 'cmb2' ),
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
		'description' => __( 'Herramientas / Tecnologías', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Herramienta {#}', 'cmb2' ),
			'add_button'    => __( 'Añadir herramienta', 'cmb2' ),
			'remove_button' => __( 'Eliminar herramienta', 'cmb2' ),
			'sortable'      => true,
			'closed'        => true,
		),
		'repeatable'  => true,
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __( 'Nombre', 'cmb2' ),
		'id'   => 'nombre',
		'type' => 'text',
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name'            => __( 'Icono — código SVG', 'cmb2' ),
		'id'              => 'icono_svg',
		'type'            => 'textarea_small',
		'desc'            => __( 'Pega el código SVG. Tiene prioridad sobre la imagen.', 'cmb2' ),
		'sanitization_cb' => false,
		'escape_cb'       => false,
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __( 'Icono — imagen', 'cmb2' ),
		'id'   => 'icono_img',
		'type' => 'file',
		'desc' => __( 'Sube una imagen si no usas SVG inline.', 'cmb2' ),
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __( 'URL (enlace del icono)', 'cmb2' ),
		'id'   => 'url',
		'type' => 'text_url',
		'desc' => __( 'Opcional. Si se rellena, el icono será un enlace.', 'cmb2' ),
	) );
}
