<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $opcionesArray, $opciones;

get_header( 'shop' ); ?>


<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		// do_action( 'woocommerce_before_main_content' );
		?>

		<?php include ('cabeceras.php') ?>

		<div class="contenedor" id="archive-product">

				<div style="width:100%">


					<?php do_action( 'woocommerce_archive_description' ); ?>

					<?php if ( have_posts() ) : ?>
					<div class="headerArchive">
						<div>
							<h1 class="page-title">

								<?php woocommerce_breadcrumb(
									array(
										'delimiter'   => '&nbsp;&#47;&nbsp;',
										'wrap_before' => '',
										'wrap_after'  => '',
										'before'      => '',
										'after'       => '',
										'home'        => ''
										)
										);//echo $datosCat->name.': '.__($datosCat->description); ?>
							</h1>

							<div class="contadorYpagerTop">
								<?php woocommerce_result_count(); ?>
								<span class="gris"> | </span>
								<?php woocommerce_catalog_ordering(); ?>
							</div>
						</div>
							<?php wc_get_template( 'loop/pagination.php' ); ?>
					</div>

						<?php //do_action( 'woocommerce_before_shop_loop' ); ?>


						<?php woocommerce_product_loop_start(); ?>

						<?php woocommerce_product_subcategories(); ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>

						<?php woocommerce_product_loop_end(); ?>


						<?php //do_action( 'woocommerce_after_shop_loop' ); ?>
						<div class="footerAervhive">
							<?php wc_get_template( 'loop/pagination.php' ); ?>
						</div>

					<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

						<?php wc_get_template( 'loop/no-products-found.php' ); ?>

					<?php endif; ?>

					<?php
			/**
			 * woocommerce_after_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */

			//do_action( 'woocommerce_after_main_content' );
			?>
			<?php
			/**
			 * woocommerce_sidebar hook
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			// do_action( 'woocommerce_sidebar' );
			?>
		</div>




</div>

<?php get_footer( 'shop' ); ?>

