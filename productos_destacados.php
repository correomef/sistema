<?php
/*
Template Name: destacados
*/ ?>
<?php
	$args = array(
	'post_type' => 'product',
	'meta_key' => '_featured',
	'posts_per_page' => 4,
	'columns' => '3',
	'meta_value' => 'yes'
	);

	$loop = new WP_Query( $args );
	wp_reset_query();
?>
<div class="productosDestacados">
	<div class="productosDestacados_titulo">
		<?php idioma('Featured Products','Productos Destacados',''); ?>
	</div>
	
		<ul class="products">
			<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>

			    <?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; ?>
		</ul>

	

</div>