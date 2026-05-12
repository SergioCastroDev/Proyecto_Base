<?php

add_action( 'cmb2_admin_init', 'section_projects_register_metabox' );
function section_projects_register_metabox() {
	$prefix = 'section_projects_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Bloque Section Projects', 'cmb2' ),
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
		'type' => 'textarea_small',
	) );

	$group_field_id = $cmb->add_field( array(
		'id'          => $prefix . 'items',
		'type'        => 'group',
		'description' => __( 'Proyectos', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Proyecto {#}', 'cmb2' ),
			'add_button'    => __( 'Añadir proyecto', 'cmb2' ),
			'remove_button' => __( 'Eliminar proyecto', 'cmb2' ),
			'sortable'      => true,
			'closed'        => true,
		),
		'repeatable'  => true,
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __( 'Nombre del proyecto', 'cmb2' ),
		'id'   => 'nombre',
		'type' => 'text',
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __( 'Descripción', 'cmb2' ),
		'id'   => 'descripcion',
		'type' => 'textarea_small',
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __( 'URL del proyecto', 'cmb2' ),
		'id'   => 'url',
		'type' => 'text_url',
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __( 'Imagen', 'cmb2' ),
		'id'   => 'imagen',
		'type' => 'file',
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __( 'Video', 'cmb2' ),
		'id'   => 'video',
		'type' => 'text_url',
		'desc' => __( 'URL de un archivo de vídeo (mp4/webm) o de YouTube. Se detecta automáticamente.', 'cmb2' ),
	) );
}
