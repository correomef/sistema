<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	$loop = 0;
	?>
	<div id="sliderEntrada" class="celda invisible">

		<ul>

			<?php foreach ( $attachment_ids as $attachment_id ) {

					$image_link = wp_get_attachment_image_src( $attachment_id, 't768')[0];//wp_get_attachment_url( $attachment_id );

					?>

					<li>
						<?php // if ($loop === 0) echo '<div class="images">' ?>
							<img src="<?php echo $image_link ?>"/>
						<?php // if ($loop === 0) echo '</div>' ?>
					</li>

					<?php

					if ( ! $image_link )
						continue;

					$loop++;

				}

			?>
		</ul>

		<?php if (count($attachment_ids) > 1) { ?>

			<div class="contenedorMiniaturas ">
				<div id="miniaturas">


					<?php $loop 		= 0;

						$i = 0;
						foreach ( $attachment_ids as $attachment_id ) :
							$image_link = wp_get_attachment_image_src( $attachment_id, 't768')[0]; ?>

		    				<div class="mini <?php if ($i ===0) echo 'activa'; ?>" data-slide-index="<?php echo $i++; ?>" ><img src="<?php echo $image_link ?>"/></div>

							<?php

							if ( ! $image_link )
								continue;

							$loop++;

						endforeach; ?>


				</div>
			</div>
		<?php } ?>
	</div>
	<?php
} else{ ?>
	<div id="sliderEntrada" class="celda imagenVacia"></div>
<?php }