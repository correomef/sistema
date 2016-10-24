<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

	<?php do_action( 'woocommerce_before_single_product' ); ?>

	<?php
	if ( post_password_required() ) {
		echo get_the_password_form();
		return;
	}

	global $post, $product, $opciones;?>


	<div class="bannerPagina">
		<?php
		$images = rwmb_meta( 'cabeceraEntrada', 'type=image_advanced' );
		if (!empty($images)):
				foreach ( $images as $image ) : ?>
					<img data-peso="<?php echo pesoFile( $image['full_url'] ) ?>" data-bp="bp3" data-imgCel="<?php echo wp_get_attachment_image_src( $image['ID'], 't768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( $image['ID'], 't1352')[0] ?>" src="">
				<?php  endforeach;	?>
		<?php endif; ?>
	</div>

		<div  id="fichaProducto" class="contenedor">

			<div class="fichaProducto-header">
				<?php

	                $cats = get_the_terms( get_the_ID(), 'product_cat' );

	                usort($cats, "cmp");
	                $breadcrumb ='';
	                foreach ($cats as $cat ){
	                	if ($cat->slug !== 'novedades' && $cat->slug !== 'destacado-en-menu') {
		                	$breadcrumb.= $cat->name;
		                	if ($cat !== end($cats)) $breadcrumb.= ' - ';
	                	}
	                }
				 ?>
				<h2 class="page-title"><?php echo $breadcrumb; ?></h2>


			</div>

			<div class="ContfichaProducto">

				<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?> >

					<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
					<div class="infoProducto-Contenedor">


						<div class="infoProducto">

							<div class="summary entry-summary">

								<?php woocommerce_template_single_title(); ?>

								<div class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></span></div>

								<div class="descripcion ">
									<h2><?php idioma('Description:','Descripción',''); ?></h2>

									<?php /*if( $product->product_type !== 'variable'):*/ ?>
										<div><?php the_content(); ?></div>
									<?php/* endif;*/ ?>

								</div>




							</div>

							<?php if ( $product->is_in_stock() ) : ?>

								<?php if ($product->product_type !== 'variable') woocommerce_template_single_price(); ?>


								<?php woocommerce_template_single_add_to_cart();?>



								<!-- <button type="submit" data-product_id="<?php echo $product->id ?>" data-product_sku="<?php echo $product->get_sku() ?>" data-quantity="1" class="add_to_cart_button button product_type_simple"><?php idioma('ADD TO CART','AGREGAR A CARRITO','ADICIONAR AO CARRINHO') ?></button> -->

							<?php endif; ?>

							<?php $imgTabla = rwmb_meta( 'tablaDeTalles', 'type=image_advanced&size=movil' ) ; ?>
							<?php if ( !empty( $imgTabla ) ): ?>
								<img class="tablaDeTalles" data-peso="<?php echo pesoFile( wp_get_attachment_image_src( array_values($imgTabla)[0]['ID'], '768')[0] ) ?>" data-bp="bp3" data-imgCel="<?php echo wp_get_attachment_image_src( array_values($imgTabla)[0]['ID'], '768')[0]; ?>" data-imgGrande="<?php echo wp_get_attachment_image_src( array_values($imgTabla)[0]['ID'], 't1352')[0] ?>" src="">
							<?php endif; ?>


						</div>

						<meta itemprop="url" content="<?php the_permalink(); ?>" />

					</div>

					<!-- <div class="tuOrden">

						<?php  // the_widget('WC_Widget_Cart');  ?>

					</div> -->
				</div>
			</div>
		</div>
		<div class="productosDestacados">

				<?php include ('single-product/related.php'); ?>


		</div>


<?php do_action( 'woocommerce_after_single_product' ); ?>









