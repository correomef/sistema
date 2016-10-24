<?php
/*
templateTemplate Name: media*/

include('header.php'); ?>

<?php include 'woocommerce/cabeceras.php' ?>

<div class="contenedor" id="pagina-galeria">
			<div class="headerArchive">
				<div>
					<!-- <h1 class="page-title">

						<?php woocommerce_breadcrumb(
							array(
								'delimiter'   => '&nbsp;&#47;&nbsp;',
								'wrap_before' => '',
								'wrap_after'  => '',
								'before'      => '',
								'after'       => '',
								'home'        => ''
								) ); ?>

					</h1> -->
					<div class="contadorYpagerTop">
						<?php

						$IdCatNov = get_cat_ID( 'descubrir' );
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



					<?php  if ($recent->have_posts()){ ?>


				<div class="contenedorGaleria <?php if ($total > 3) echo 'spaceBetween '?>">
					<?php

						echo '<h2>'.$total.'</h2>';

					function plantillaEntradaGalria() {
						global $imgDestacada, $imgCel, $video; ?>
						<div class="galeria <?php if ($video !== '') echo 'galeria-video' ?>">
							<p class="galeria-titulo" title="<?php echo get_the_title(); ?>"><?php echo get_the_title() ?></p>
							<a class="imagen" href="<?php the_permalink(); ?>">
								<?php if (!empty($imgDestacada)){ ?>
								<img data-imgCel="<?php echo $imgCel ?>" data-bp="bp3" data-imgGrande="<?php echo $imgDestacada ?>" src="">
								<?php } ?>
							</a>
							<a href="<?php the_permalink(); ?>" class="vermasGaleria"><?php echo idioma('See More','Ver Mas','Ver mais'); ?></a>
							<p class="titulo" title="<?php echo get_the_title(); ?>"><?php echo get_the_title() ?></p>
							<p class="descripcion"><?php echo get_the_content()?></p>
						</div>

					<?php }



						while($recent->have_posts()) { $recent->the_post();

							$imgDestacada = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID), 'destacada')[0];

							$video = rwmb_meta( 'video', 'type=oembed' );

							plantillaEntradaGalria();

						};
					};

					wp_reset_postdata(); ?>
		</div>

	</div>
	<?php include('footer.php');  ?>
