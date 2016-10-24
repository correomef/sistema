<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>
<li data-estado="<?php echo idioma('OUTOFSTOCK', 'AGOTADO', '', 'noEcho') ?>"  <?php post_class( $classes ); ?> >
	<div class="apretadorDestacados">
		<?php
		/**
		 * woocommerce_before_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		// do_action( 'woocommerce_before_shop_loop_item' );

		/**
		 * woocommerce_before_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
	?>

	<?php if( $product->product_type === 'variable'): ?>
		<div class="apapareceOnHover">

			<?php

			//do_action( 'woocommerce_after_shop_loop_item_title' );

			/**
			 * woocommerce_after_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			// do_action( 'woocommerce_after_shop_loop_item' );
			?>
			<?php woocommerce_template_loop_add_to_cart(); ?>




			<div class="switchColorPanel conScroll">
				<!-- <div id="scroll-down"></div>
				<div id="scroll-up"></div> -->
				<?php
				if( $product->product_type == 'variable'){

					$available_variations = $product->get_available_variations();

					//print_r($available_variations);
					$colorLeido = array();

					$variaicionesS = $available_variations;


					usort($variaicionesS, "turito");

					foreach( $variaicionesS as $variation => $value){
						if(!in_array($value['attributes']['attribute_pa_color'], $colorLeido) ){

							echo '<img class="switchColor" data-select="' . $value['attributes']['attribute_pa_color'] . '" data-size="' . $value['attributes']['attribute_pa_size'] . '" src="' . wp_get_attachment_image_src(get_post_thumbnail_id( $value['image-id']), 't43')[0] .'">';

						}
						array_push($colorLeido,$value['attributes']['attribute_pa_color']);
					}
				}
				?>
			</div>
		</div>
	<?php endif; ?>

	<?php if( $product->product_type !== 'variable'): ?>
		<div class="apapareceOnHover apapareceOnHover_simple ">
			<div class="variaciones">

				<?php wc_get_template( 'single-product/add-to-cart/simple.php' ); ?>
			</div>
		</div>
	<?php endif; ?>

		<div class="images">
	<?php
			//do_action( 'woocommerce_before_shop_loop_item_title' );

			$imgDestacada = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID), 't768')[0];

			//$tituloDeImagen = get_post(get_post_thumbnail_id())->post_title;
			?>


			<!-- <img srcset="<?php echo $imgDestacada ?> 500w, <?php echo $imgCel ?> 220w" src="<?php echo $imgDestacada ?>"> -->
			<a href="<?php echo get_the_permalink() ?>"> <img data-imgCel="" data-bp="bp3" data-imgGrande="<?php echo $imgDestacada ?>" title ="<?php echo get_the_title() ?>" alt="<?php echo get_the_title() ?>" src=""></a>
		</div>
		<div class="infoContenProduct">
			
			<a href="<?php echo get_the_permalink() ?>" title="get_the_title()"><h3><?php echo resumen(get_the_title(), 19, false); ?></h3></a>
			<p><?php echo resumen(get_the_content(), 35, false); ?></p>
			<?php wc_get_template( 'loop/price.php' ); ?>
		</div>





	</div>

</li>
