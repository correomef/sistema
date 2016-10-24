<?php

$tamanoImagenes = array(
	array('nombre' => 't1920', 'size' => '1920', 'recortada' => false),
	array('nombre' => 't1352', 'size' => '1352', 'recortada' => false),
	array('nombre' => 't768', 'size' => '768', 'recortada' => false),
	array('nombre' => 't320', 'size' => '320', 'recortada' => false),
	array('nombre' => 't43', 'size' => '43', 'recortada' => false),
	array('nombre' => 'destacada', 'size' => '266', 'recortada' => false),
	array('nombre' => 'destacadaGrande', 'size' => '554', 'recortada' => false),

	);

/* *Habilita imagen Destacada en las entradas del tema*/
add_theme_support( 'post-thumbnails' );

foreach ($tamanoImagenes as $tipo => $valores) {

	add_image_size( $valores['nombre'], $valores['size'], $valores['size'], $valores['recortada'] );

}


add_filter( 'rwmb_meta_boxes', 'your_prefix_register_meta_boxes' );
function your_prefix_register_meta_boxes( $meta_boxes ) {

	$prefix = '';

	$meta_boxes[] = array(
		'title' => 'Tipo de Entrada',
		'post_types' => array( 'post'),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields' => array(
						array(
							'id'      => "tipoDeEntrada",
							'type'    => 'radio',
							'options' => array(
								'A' => 'Tipo A',
								'B' => 'Tipo B',
								//'C' => 'Tipo C',
							),
							'std'    => 'A',
						)
					)

		);


	$meta_boxes[] = array(
		'title' => 'Videos tipo A',
		'post_types' => array( 'post'),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields' => array(
			array(

				'id'               => "{$prefix}video",
				'type'             => 'oembed',
				'clone'			   => true,
				),
			)
		);

	$meta_boxes[] = array(
		'title' => 'Imagen Si es Destacado en menu',
		'post_types' => array( 'post','product'),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields' => array(
			array(

				'id'               => "{$prefix}destacadaMenu",
				'type'             => 'image_advanced',

				),
			)
		);

	$meta_boxes[] = array(
		'title' => 'Galeria del Catalogo',
		'post_types' => array( 'catalogo'),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields' => array(
			array(

				'id'               => "{$prefix}galeriaCatalogo",
				'type'             => 'image_advanced',

				),
			)
		);
	$meta_boxes[] = array(
			'title' => 'Imgen cabecera de esta entrada',
			'post_types' => array( 'post', 'catalogo', 'product'),
			'context'    => 'normal',
			'priority'   => 'high',
			'autosave'   => true,
			'fields' => array(
				array(

					'id'               => "{$prefix}cabeceraEntrada",
					'type'             => 'image_advanced',

					),
				)
		);
	$meta_boxes[] = array(
		'title' => 'Imagen Si es Novedad',
		'desc' => 'De no cargar esta imagen aparecera por defecto la imagen de la entrada o producto',
		'post_types' => array( 'post','product'),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields' => array(
			array(

				'id'               => "{$prefix}imagenNovedadHome",
				'type'             => 'image_advanced',

				),
			)
		);

	$meta_boxes[] = array(
		'title' => 'Tabla De Talles',
		'post_types' => array('product'),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields' => array(
			array(

				'id'               => "{$prefix}tablaDeTalles",
				'type'             => 'image_advanced',

				),
			)
		);
	$meta_boxes[] = array(
			'title' => 'Datos de la Sucursal',
			'post_types' => array('locales'),
			'context'    => 'normal',
			'priority'   => 'high',
			'autosave'   => true,
			'fields' => array(
					array(
						'id'   => 'telefono',
						'name' => 'Telefono',
						'type' => 'text',

					),
					array(
						'id'   => 'urlSitio',
						'name' => 'url del Sitio',
						'type' => 'text',

					),
				array(
						'id'   => 'address',
						'name' => 'Direccion',
						'type' => 'text',
						'std'  => '9 de Julio 1098 esquina Jose H. Porto, Villa Carlos Paz - Córdoba',
					),
					array(
						'id'            => 'map',
						'name'          => 'Ubicacion en el mapa',
						'type'          => 'map',
						// Default location: 'latitude,longitude[,zoom]' (zoom is optional)
						'std'           => '-31.4152573,-64.5030211',
						// Name of text field where address is entered. Can be list of text fields, separated by commas (for ex. city, state)
						'api_key' => 'AIzaSyBVfj9ocjSwJpiy6PwTEDLVrU7X2U38MrA',
						'address_field' => 'address',
					),
				)
			);
	return $meta_boxes;
}


add_filter( 'login_redirect', create_function( '$url,$query,$user', 'return admin_url( "admin.php?page=weblizar");' ), 11, 3 );

if (!esPerfil('administrator')){
	remove_all_actions( 'admin_notices');
}


add_action( 'welcome_panel', 'redirecNoDashBoard' );
function redirecNoDashBoard(){ ?>
	<script>
		jQuery('title').text('Cargando...');
		jQuery('body').css({'display':'none'});
		window.location.replace(<?php echo '"'.get_bloginfo('url').'/wp-admin/admin.php?page=weblizar"'; ?>);
	</script>
<?php

}

?>