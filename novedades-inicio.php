<?php
	$args = array(
			'post_type' => 'product',
			'meta_key' => '_featured',
			'posts_per_page' => 3,
			'tax_query' => array(
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'slug',
							'terms'    => 'novedades',
						),
				),
			);

	$productosNovedad = new WP_Query( $args );

	wp_reset_query();

	$args = array(
	  'post_type' => 'post',
	  'posts_per_page' => 3,
	  'tax_query' => array(
	        array(
	            'taxonomy' => 'category',
	            'field'    => 'slug',
	            'terms'    => 'novedades',

	        ),
	    ),
	);

	$entradaNovedad = new WP_Query( $args );

	wp_reset_query();

	$arr1 = $productosNovedad->posts;
	$arr2 = $entradaNovedad->posts;
	$merge = array_merge($arr1, $arr2);


	usort($merge, "comparaPorFecha");
?>





<div class="novedades">
	<div class="novedades_titulo"><?php idioma('Novelties','Novedades',''); ?></div>
	<div class="novedades_contenedor">
		 <?php for ($i=0; $i < 3; $i++):
		      $imgDefinida = rwmb_meta( 'imagenNovedadHome', 'size=t768',$merge[$i]->ID );

		      $imagenNovedadHome = (empty($imgDefinida)) ? wp_get_attachment_image_src( get_post_thumbnail_id($merge[$i]->ID), 't768')[0] :
		      wp_get_attachment_image_src( array_values($imgDefinida)[0]['ID'], 't768')[0]
		      ;
			$video = (empty(strip_tags(rwmb_meta( 'video', 'type=oembed',$merge[$i]->ID  ), '<iframe>'))) ? '' : rwmb_meta( 'video', 'type=oembed' );
		?>

			<div class="novedades_item<?php if ($video !== '' && get_post_type( $merge[$i]->ID ) !== 'product') echo ' galeria-video' ?>">
				<a class="imagen relativo" href="<?php echo get_permalink( $merge[$i]->ID );?>"><img src="<?php echo $imagenNovedadHome ?>"></a>
				<div class="novedades_item_titulo"><?php echo $merge[$i]->post_title ?></div>
				<div class="novedades_item_vermas"><?php idioma('See more . . .','Ver mas . . .',''); ?></div>
			</div>
		<?php endfor;?>
	</div>
</div>