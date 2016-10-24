<?php
/*
Template Name: pagina-descubrir
*/



 include('header.php');

$categoria = 'descubrir';

?>


<?php if ( key_exists('cabeceras-'.$categoria.'-imagen-img', $opciones) ): ?>

<div class="bannerPagina">
	<img data-peso="<?php echo pesoFile($opciones['cabeceras-'.$categoria.'-imagen-img']) ?>" data-bp="bp3" data-imgCel="<?php echo wp_get_attachment_image_src( $opciones['cabeceras-'.$categoria.'-imagen-id'], 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( $opciones['cabeceras-'.$categoria.'-imagen-id'], 't1352')[0] ?>" src="">
</div>
<?php endif ?>

<?php if ( key_exists('cabeceras-'.$categoria.'-titulo', $opciones) ):?>
	<div class="encabesadoTexto">
		<div class="contenedor">
			<h1 class="page-title"><?php echo $opciones['cabeceras-'.$categoria.'-titulo'] ?> </h1>
			<p class="page-subtitle"><?php echo $opciones['cabeceras-'.$categoria.'-subtitulo'] ?></p>

		</div>
	</div>
<?php endif; ?>

<div class="contenedor" id="paginaSingle">

			<?php

			$IdCatNov = get_cat_ID( $categoria );
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;


			$args = array(
			  'cat'            => $IdCatNov,
			  'paged'          => $paged,
			  'posts_per_page' => 1,
			);

			$recent = new WP_Query($args);


		if ($recent->have_posts()){


			while($recent->have_posts()) { $recent->the_post(); ?>


							<meta property="og:image" content="<?php $featuredimg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'Full')[0]; echo $featuredimg; ?>" />
							<article>

								<?php if ( rwmb_meta('tipoDeEntrada', 'type=radio') === 'B') { ?>

									<p class="content conScroll"><?php echo textareaEntreTexto(get_the_content(),'','<br>') ?></p>

										<div class="gruposTipoB">
											<?php $fields = CFS()->get( 'gruposB' );?>




											<?php foreach ( $fields as $field ) : ?>
												<div class="grupo">
													<?php if (!empty($field['imagen'])): ?>
														<img data-bp="bp3" data-imgCel="<?php echo wp_get_attachment_image_src( $field['imagen'], 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( $field['imagen'], 't1352')[0] ?>" src="">
													<?php endif ?>
													<div class="infoGrupo">
														<h2><?php echo __($field['titulo']); ?></h2>
														<div class="content conScroll"><?php echo $field['texto']; ?></div>
														<?php if (!empty($field['archivo']) ): ?>
															<?php idioma('Link: ','Adjunto: ','Link: '); ?><a target="_blank" href="<?php echo $field['archivo']; ?>"><?php echo $field['archivo']; ?></a>
														<?php endif; ?>
													</div>
												</div>

											<?php endforeach; ?>

										</div>
								<?PHP }

								elseif ( rwmb_meta('tipoDeEntrada', 'type=radio') === 'C') { ?>

										<p class="content conScroll"><?php echo textareaEntreTexto(get_the_content(),'','<br>') ?></p>

											<div class="gruposTipoC">
												<?php $fields = CFS()->get( 'gruposB' ); ?>
												<div class="oculto">
													<p>andubo</p>
													<?php echo strip_tags(get_post_meta( $post->ID, 'texto' )[0]); ?>
												</div>
												<?php foreach ( $fields as $field ) : ?>
													<div class="grupo">
														<?php if (!empty($field['imagen'])): ?>
															<div class="imagenDeGrupoC">
																<img data-bp="bp3" data-imgCel="<?php echo wp_get_attachment_image_src( $field['imagen'], 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( $field['imagen'], 't1352')[0] ?>" src="">
															</div>
														<?php endif ?>
														<div class="infoGrupo">
															<h2><?php echo  __($field['titulo']); ?></h2>
															<div class="content conScroll"><?php echo $field['texto']; ?></div>
															<?php if (!empty($field['archivo']) ): ?>
																<?php idioma('Link: ','Adjunto: ','Link: '); ?><a target="_blank" href="<?php echo $field['archivo']; ?>"><?php echo $field['archivo']; ?></a>
															<?php endif; ?>
														</div>
													</div>

												<?php endforeach; ?>

											</div>
									<?PHP } else{

									$video = rwmb_meta( 'video', 'type=oembed' ); ?>

									<?php if ($video !== ''): ?>

											<div id="sliderSingle" class="slider video">
												<?php echo $video ?>
											</div>

											<p class="content conScroll"><?php echo textareaEntreTexto(get_the_content(),'','<br>') ?></p>

											<div class="contenedorMiniaturasSINGLE">
												<div id="miniaturasSingle" class="miniaturaVideo video">

													<?php echo $video ?>

												</div>
											</div>


									<?php endif; ?>


								<?php } ?>

								<?php include('compartir.php'); ?>


							</article>

			<? };
		};

		wp_reset_postdata(); ?>

</div>
	<?php include('footer.php');  ?>