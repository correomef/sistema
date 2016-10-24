<?php
/*

*/

include('header.php'); ?>
<?php if ( key_exists('cabeceras-novedades-img') && $opciones['cabeceras-novedades-img'] != '' ): ?>
<div class="bannerPagina">
	<img data-peso="<?php echo pesoFile($opciones['cabeceras-novedades-img']) ?>" data-bp="bp3" data-imgCel="<?php echo wp_get_attachment_image_src( $opciones['cabeceras-novedades-id'], 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( $opciones['cabeceras-novedades-id'], 't1352')[0] ?>" src="">
</div>
<?php endif ?>
<div class="contenedor" id="pagina-novedades">
	<h1 class="page-title">

		<?php woocommerce_breadcrumb(
			array(
				'delimiter'   => '&nbsp;&#47;&nbsp;',
				'wrap_before' => '',
				'wrap_after'  => '',
				'before'      => '',
				'after'       => '',
				'home'        => ''
				) ); ?>

			</h1>
			<div class="contadorYpagerTop">
				<?php

				$IdCatNov = get_cat_ID( 'galeria' );

				$recent = new WP_Query("cat=".$IdCatNov);
				$paged    = max( 1, $recent->get( 'paged' ) );
				$per_page = $recent->get( 'posts_per_page' );
				$total    = $recent->found_posts;
				$first    = ( $per_page * $paged ) - $per_page + 1;
				$last     = min( $total, $recent->get( 'posts_per_page' ) * $paged );
				wp_reset_postdata();

				function paginacion($recent ,$paged ,$per_page ,$total ,$first ,$last){?>
					<p class="woocommerce-result-count">
						<?php if ( 1 == $total ) {
							_e( 'Showing the single result', 'woocommerce' );
						} elseif ( $total <= $per_page || -1 == $per_page ) {
							printf( __( 'Showing all %d results', 'woocommerce' ), $total );
						} else {
							idioma('Showing '.$first.'-'.$last.' of '.$total. ' products', 'Mostrando '.$first.'-'.$last.' de '.$total. ' resultados', 'pt');
						}
						?>
					</p>
					<div class="woocommerce-pagination">
						<?php


						echo '<span class="gris"> | '.idioma(' Page ', ' Página ', '','noEcho') . '<span class="negro">'. $paged .'</span>' . idioma(' of ', ' de ', '','noEcho') .  '<span class="negro">'.ceil( $total / $per_page ) .'</span>'. '</span> ';
						posts_nav_link($sep,'&#9666;','&#9656;');
						?>
					</div>

					<?php }
					query_posts("cat=".$IdCatNov );
					paginacion($recent ,$paged ,$per_page ,$total ,$first ,$last);?>
				</div>
				<ul class="products tablaCentrada">
					<?php


					if (have_posts()):


						while(have_posts()) : the_post();?>
					<li>
						<div class="agregaMargenDerecho">

							<?php  $video = rwmb_meta( 'video', 'type=oembed' ); ?>
							<div class="relativo <?php if ($video !== '') echo 'galeria-video' ?>">
								<a class="linkFlotante" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
								<?php $imgDestacada = wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 'destacada') ); ?>
								<?php $imgCel = wp_get_attachment_url( get_post_thumbnail_id( $post->ID, 't768') ); ?>
								<img data-imgCel="<?php echo $imgCel ?>" data-bp="bp3" data-imgGrande="<?php echo $imgsrc ?>" src="">
								<h3><?php echo get_the_title()?></h3>
							</div>
						</div>
					</li>
				<?php endwhile; ?>
			<?php endif; ?>
		</ul>
		<div class="contadorYpagerbottom">
			<div class="woocommerce-pagination">
				<p class="woocommerce-result-count">
					<?php  paginacion($recent ,$paged ,$per_page ,$total ,$first ,$last); ?>
			</div>
		</div>
	</div>
	<?php include('footer.php');  ?>
