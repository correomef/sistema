<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

include('header.php'); ?>


	<div class="contenedor">

		<div class="tablaCentrada">

			<?php // if (!is_page('cart')): ?>

				<!-- <div class="celda tuOrden">
					<h2><?php idioma('YOUR ORDER','TU ORDEN','SEU PEDIDO','Ihre Bestellung') ?></h2>

					<?php  the_widget('WC_Widget_Cart');  ?>
				</div> -->

			 <?php //endif ?>

			<div <?php if (is_page('mi-compra')) echo 'id="miCompra"' ?> >
				<?php


				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();

						echo do_shortcode(get_the_content());

					}
				}
				?>
			</div>

		</div>


	</div>

<?php get_footer(); ?>


