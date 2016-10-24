<?php include('header.php'); ?>

<?php if ( key_exists('cabeceras-'.$categoria.'-imagen-img', $opciones) ): ?>
<div class="bannerPagina">
	<img data-peso="<?php echo pesoFile($opciones['cabeceras-'.$categoria.'-imagen-img']) ?>" data-bp="bp3" data-imgCel="<?php echo wp_get_attachment_image_src( $opciones['cabeceras-'.$categoria.'-imagen-id'], 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( $opciones['cabeceras-'.$categoria.'-imagen-id'], 't1352')[0] ?>" src="">
</div>
<?php endif ?>
<div class="contenedor" id="pagina-galeria">
			<?php if ( key_exists('cabeceras-'.$categoria.'-titulo', $opciones) ):?>
				<div class="encabesadoTexto">
					<h1 class="page-title"><?php echo $opciones['cabeceras-'.$categoria.'-titulo'] ?> </h1>
					<p class="page-subtitle"><?php echo $opciones['cabeceras-'.$categoria.'-subtitulo'] ?></p>
				</div>
			<?php endif; ?>
			<div class="headerArchive">
				<div>


					<div class="contadorYpagerTop">
						<?php

						$IdCatNov = get_cat_ID( $categoria );
						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;


						$args = array(
						  'cat'            => $IdCatNov,
						  'paged'          => $paged
						);

						$recent = new WP_Query($args);
						//query_posts($args);

						//$paged    = max( 1, $recent->get( 'paged' ) );
						$per_page = $recent->get( 'posts_per_page' );
						$total    = $recent->found_posts;
						$first    = ( $per_page * $paged ) - $per_page + 1;
						$last     = min( $total, $recent->get( 'posts_per_page' ) * $paged );

						//wp_reset_postdata();

						function paginacion($recent ,$paged ,$per_page ,$total ,$first ,$last, $cantPaginas = '1'){?>

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


				<div class="contenedorGaleria <?php if ($total > 3) echo 'spaceBetween '?>">
					<?php


					function plantillaEntradaGalria() {
						global $imgDestacada, $imgCel, $video; ?>
						<div class="galeria <?php if ($video !== '') echo 'galeria-video' ?>">
							<p class="galeria-titulo" title="<?php echo get_the_title(); ?>"><?php echo get_the_title() ?></p>
							<a class="imagen" href="<?php the_permalink(); ?>">
								<?php if (!empty($imgDestacada)){ ?>
								<img data-imgCel="<?php echo $imgCel ?>" data-bp="bp3" data-imgGrande="<?php echo $imgDestacada ?>" src="">
								<?php } ?>
							<a class="imagen" href="<?php the_permalink(); ?>">
							<!-- <a href="<?php the_permalink(); ?>" class="vermasGaleria"><?php echo idioma('See More','Ver Mas','Ver mais'); ?></a> -->
							<a href="<?php the_permalink(); ?>"><p class="titulo" title="<?php echo get_the_title(); ?>"><?php echo get_the_title() ?></p></a>
							<p class="descripcion"><?php echo resumen( __(get_the_content() ) )?></p>
						</div>

					<?php }

					if ($recent->have_posts()){


						while($recent->have_posts()) { $recent->the_post();

							$imgDestacada = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID), 'destacada')[0];

							$video = (empty(strip_tags(rwmb_meta( 'video', 'type=oembed' ), '<iframe>'))) ? '' : rwmb_meta( 'video', 'type=oembed' );

							plantillaEntradaGalria();

						};
					};

					wp_reset_postdata(); ?>
		</div>

	</div>
	<?php include('footer.php');  ?>