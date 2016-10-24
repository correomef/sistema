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
				<div class="contenedor">
					<div class="bordeMap">
						<div id="catalogoSlider" class="slider">

							<?php $galeria = rwmb_meta( 'galeriaCatalogo', 'type=image_advanced' );
							if (!empty($galeria)): ?>
								<ul>
									<?php $cont = 1;
										foreach ( $galeria as $image ) :
											$src = ($cont <= 2) ? wp_get_attachment_image_src( $image['ID'], 't1352')[0] : ''; ?>
											<li><img src="<?php echo $src;?>" alt="" data-srcCel="<?php echo wp_get_attachment_image_src( $image['ID'], 't768')[0]; ?>"
											data-srcGrande="<?php echo wp_get_attachment_image_src( $image['ID'], 't1352')[0] ?>"></li>

										<?php $cont++; ?>
									<?php  endforeach;	?>
								</ul>
							<?php endif; ?>

						</div>
					</div>
				</div>
			</article>

		<?php endwhile; ?>

</div>

<?php include('footer.php');  ?>