<?php include('header.php'); ?>


<div class="bannerPagina">
	<?php
	$images = rwmb_meta( 'cabeceraEntrada', 'type=image_advanced' );
	if (!empty($images)):
			foreach ( $images as $image ) : ?>
				<img data-peso="<?php echo pesoFile( $image['full_url'] ) ?>" data-bp="bp3" data-imgCel="<?php echo wp_get_attachment_image_src( $image['ID'], 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( $image['ID'], 't1352')[0] ?>" src="">
			<?php  endforeach;	?>
	<?php endif; ?>
</div>

<div id="paginaSingle">

		<?php while ( have_posts() ) : the_post() ?>
			<div class="contenedor">
				<div class="headerArchive">
					<div>
						<h1 class="breadcrums"><?php the_title(); ?></h1>
					</div>
				</div>
			</div>

			<article>

				<?php if ( rwmb_meta('tipoDeEntrada', 'type=radio') === 'B') { ?>

					<?php $fields = CFS()->get( 'gruposB' ); ?>

					<div class="gruposTipoB">


						<?php
							$contador = 1;
							foreach ( $fields as $field ) : ?>
							<div class="grupo">

								<?php if (!empty($field['imagen'])): ?>
									<img class="apareceVideo" data-target="#sliderSingle" data-bp="bp3" data-imgCel="<?php echo wp_get_attachment_image_src( $field['imagen'], 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( $field['imagen'], 't1352')[0] ?>" src="">
								<?php endif ?>
							</div>

							<?php if ($contador == 2 || count($fields) < 2) :?>
								<div class="contenedor"><div class="content "><?php the_content();?></div></div>
							<?php endif;?>

							<?php $contador++; ?>

						<?php endforeach; ?>

					</div>

					<div id="sliderSingle" class="slider">
						<div class="contenedor">

							<div class="close topCero">×</div>
							<ul>
								<?php foreach ( $fields as $field ) : ?>
									<li>
										<div class="grupo">
											<div class="infoGrupo">
												<h2><?php echo __($field['titulo']); ?></h2>
												<div class="content "><?php echo $field['texto']; ?></div>
												<?php if (!empty($field['archivo']) ): ?>
													<?php idioma('Link: ','Adjunto: ','Link: '); ?><a target="_blank" href="<?php echo $field['archivo']; ?>"><?php echo $field['archivo']; ?></a>
												<?php endif; ?>
											</div>


											<?php if (!empty($field['imagen'])): ?>
												<img data-bp="bp3" data-imgCel="<?php echo wp_get_attachment_image_src( $field['imagen'], 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( $field['imagen'], 't1352')[0] ?>" src="">
											<?php endif; ?>
										</div>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				<?PHP }

				elseif ( rwmb_meta('tipoDeEntrada', 'type=radio') === 'C') { ?>

						<div class="content "><?php the_content();?></div>

							<div class="gruposTipoC">
								<?php $fields = CFS()->get( 'gruposB' );?>



								<?php foreach ( $fields as $field ) : ?>
									<div class="grupo">
										<?php if (!empty($field['imagen'])): ?>
											<div class="imagenDeGrupoC">
												<img data-bp="bp3" data-imgCel="<?php echo wp_get_attachment_image_src( $field['imagen'], 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( $field['imagen'], 't1352')[0] ?>" src="">
											</div>
										<?php endif ?>
										<div class="infoGrupo">
											<h2><?php echo  __($field['titulo']); ?></h2>
											<div class="content "><?php echo $field['texto']; ?></div>
											<?php if (!empty($field['archivo']) ): ?>
												<?php idioma('Link: ','Adjunto: ','Link: '); ?><a target="_blank" href="<?php echo $field['archivo']; ?>"><?php echo $field['archivo']; ?></a>
											<?php endif; ?>
										</div>
									</div>

								<?php endforeach; ?>

							</div>
					<?PHP } else{

					$video = rwmb_meta( 'video', 'type=oembed' ); ?>

					<div class="contenedor">

						<img class="imagenDestacadaSingle" data-bp="bp3" data-imgCel="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 't1352')[0] ?>" src="">

						<?php if ($video !== ''): ?>


								<div class="content"><?php the_content();?></div>

								<?php

								$cuantosIframe = count(explode('<iframe', strip_tags(rwmb_meta( 'video', 'type=oembed' ), '<iframe>'))) - 1;
								if ($cuantosIframe > 1): ?>
									<div class="contenedorMiniaturasSINGLE apareceVideo" data-target="#sliderSingle">
										<h2><?php idioma('Related Videos','Videos Relacionados',''); ?></h2>
										<div id="" class="miniaturaVideo video">

											<?php echo $video ?>

										</div>
									</div>
								<?php endif ?>


						<?php endif; ?>

					</div>
					<?php if ($video !== ''): ?>

							<div id="sliderSingle" class="slider video">
								<div class="contenedor">
									<div class="close topCero">×</div>
									<h2><?php the_title() ?></h2>
									<?php echo $video ?>
								</div>
							</div>
					<?php endif; ?>

				<?php } ?>

				<?php // include('compartir.php'); ?>


			</article>

		<?php endwhile; ?>

</div>

<?php include('footer.php');  ?>