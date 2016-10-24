<?php
function plantillaDestacadosInicio($tipo='chica', $video = '') {
	global $imgDestacada;

	$suma = ($tipo === 'grande') ? $suma=30 : 0; ?>


	<div class="galeria <?php if ($video !== '') echo 'galeria-video' ?>">
		<a class="imagen" href="<?php the_permalink(); ?>">
			<?php if (!empty($imgDestacada)){ ?>

			<img data-bp="bp3" data-imgGrande="<?php echo $imgDestacada ?>" src="">
			<?php } ?>
			<div class="copete">
				<p class="galeria-titulo"></p>
			</div>
		</a>
		<p class="titulo" title="<?php echo get_the_title(); ?>"><?php echo get_the_title() ?></p>
		<p class="descripcion"><?php echo get_the_content()?></p>
		<a href="<?php the_permalink(); ?>" class="vermasGaleria"><?php echo idioma('See More','Ver Mas','Ver mais'); ?></a>
		<div class="oculto">
			<?php echo $video ?>
		</div>
	</div>

<?php }

$IdCatNov = get_cat_ID( 'Destacado Inicio Grande' );

$recent = new WP_Query("cat=".$IdCatNov."&showposts=1");

if ($recent->have_posts()){

	while($recent->have_posts()) { $recent->the_post();

		$imgDestacada = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID), 'destacadaGrande')[0];
		$imgCel = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID), 't768')[0];
		$video = (empty(strip_tags(rwmb_meta( 'video', 'type=oembed' ), '<iframe>'))) ? '' : rwmb_meta( 'video', 'type=oembed' );
		//$video = rwmb_meta( 'video', 'type=oembed' );
		?>

		<?php

		plantillaDestacadosInicio('grande', $video);

	};
};

wp_reset_postdata();

$IdCatNov = get_cat_ID( 'Destacado Inicio' );

$recent = new WP_Query(
				array(
				'cat'     => $IdCatNov,
				'orderby' => 'date',
				'order'   => 'DESC',
				'posts_per_page' => '2')
			);
/*"cat=".$IdCatNov."&showposts=2");*/

if ($recent->have_posts()){


	while($recent->have_posts()) { $recent->the_post();

		$imgDestacada = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID), 'destacada')[0];


		$video = rwmb_meta( 'video', 'type=oembed' );

		plantillaDestacadosInicio('chica');

	};
};

wp_reset_postdata();

?>