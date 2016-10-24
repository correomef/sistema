<?php
/*
Template Name: inicio
*/

include('header.php');
?>

<aside id="inicio">
	<?php
	$modulo = 'inicio';
	$seccion = 'slider';
	$sliderClase = 'bxslider';
	$SliderId = 'inicio-sliderTop' ;

	include('slider.php')  ?>

</aside>

<?php include 'novedades-inicio.php' ?>

<?php include 'productos_destacados.php' ?>

<div class="entradasFinDeHome">

<?php $value = $opcionesArray['inicio'] ?>

<img class="entradasFinDeHome_banner" data-peso="<?php echo pesoFile( $value['bannerEntradasFinDeHome']['img'] ) ?>" data-bp="bp3" data-imgCel="<?php if(key_exists('id', $value['bannerEntradasFinDeHome'])) echo wp_get_attachment_image_src( $value['bannerEntradasFinDeHome']['id'], 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( $value['bannerEntradasFinDeHome']['id'], 't1920')[0] ?>" src="">

		<?php
			$args = array(
			'post_type' => 'post',
			'posts_per_page' => 2,
			'tax_query' => array(
			      array(
			          'taxonomy' => 'category',
			          'field'    => 'slug',
			          'terms'    => 'anclar-al-fin-de-home',

			      ),
			  ),
			);

			$loop = new WP_Query( $args );
			wp_reset_query();
		?>

		<?php while ( $loop->have_posts() ) : $loop->the_post();

		    $video = (empty(strip_tags(rwmb_meta( 'video', 'type=oembed'), '<iframe>'))) ? '' : rwmb_meta( 'video', 'type=oembed' ); ?>

		    <div class="entradasFinDeHome_item<?php if ($video !== '' && get_post_type() !== 'product') echo ' galeria-video' ?>">
		    				<a class="imagen relativo" href="<?php echo get_permalink();?>"><img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 't768')[0];?>"></a>
		    				<div class="entradasFinDeHome_item_titulo"><?php the_title(); ?></div>
		    				<div class="entradasFinDeHome_item_contenido"><?php the_content(); ?></div>
		    			</div>

		<?php endwhile; ?>


</div>




<?php include('footer.php');  ?>
