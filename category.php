<?php

include('header.php'); ?>
<?php include ('woocommerce/cabeceras.php') ?>
<div class="contenedor" id="pagina-galeria">

	<div class="headerArchive">
		<div>
			<h1 class="breadcrums"><?php single_cat_title();?></h1>
			<div class="contadorYpagerTop DesapareceEnMovil">
				<?php

				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;


				$args = array(
					'cat'			=> get_queried_object()->term_id,
				  'paged'          => $paged
				);

				$recent = new WP_Query($args);
				//query_posts($args);

				//$paged    = max( 1, $recent->get( 'paged' ) );
				$per_page = $recent->get( 'posts_per_page' );
				$total = get_queried_object()->count;
				$first    = ( $per_page * $paged ) - $per_page + 1;
				$last     = min( $total, $recent->get( 'posts_per_page' ) * $paged );

				//wp_reset_postdata();

				function paginacion($recent ,$paged ,$per_page ,$total ,$first ,$last, $cantPaginas){?>

					<?php  $cantPaginas = ceil($total / $per_page); ?>
					<div class="woocommerce-pagination">

						<span><?php echo $label = ($cantPaginas > 1) ? idioma('Pages: ','Páginas: ','Paginas: ', '', 'noEcho') : ''; ?></span>

						<span><?php
							echo paginate_links(  array(
								'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
								'format'       => '',
								'add_args'     => '',
								'current'      => $paged,
								'total'        => $cantPaginas,
								'prev_text'    => '',
								'next_text'    => '',
								'type'         => 'list',
								'end_size'     => 3,
								'mid_size'     => 3
							)  );
						?></span>


					</div>

					<?php }

					paginacion($recent ,$paged ,$per_page ,$total ,$first ,$last);







					?>

			</div>
		</div>
	</div>

	<div class="contenedorGaleria">
			<?php if (have_posts()):?>
				<?php while(have_posts()) : the_post();?>


						<?php

						$imgDestacada = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 't768')[0];

						$video = (empty(strip_tags(rwmb_meta( 'video', 'type=oembed' ), '<iframe>'))) ? '' : rwmb_meta( 'video', 'type=oembed' );

						 ?>
						<div class="galeria <?php if ($video !== '') echo 'galeria-video' ?>">

							<div>
								<a class="imagen" href="<?php the_permalink(); ?>">
									<?php if (!empty($imgDestacada)){ ?>
									<img data-imgCel="<?php echo $imgCel ?>" data-bp="bp3" data-imgGrande="<?php echo $imgDestacada ?>" src="">
									<?php } ?>
								</a>
								<p class="titulo" title="<?php echo get_the_title(); ?>"><?php echo get_the_title() ?></p>
								<p class="descripcion"><?php echo resumen(get_the_content(), 167, false);?></p>
							</div>
							<a href="<?php the_permalink(); ?>" class="vermasGaleria"><?php echo idioma('See More','Ver Mas','Ver mais'); ?></a>
						</div>


				<?php endwhile; ?>
			<?php endif; ?>

	</div>

	<div class="headerArchive ApareceEnMovil">
		<div>
 			<div class="contadorYpagerTop">
				<?php paginacion($recent ,$paged ,$per_page ,$total ,$first ,$last); ?>
			</div>
		</div>
	</div>
</div>
<?php include('footer.php');  ?>




