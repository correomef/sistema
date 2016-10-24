<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<?php // if (!is_product()): ?>
	<!-- <a href="<?php echo get_the_permalink() ?>" title="<?php echo get_the_title(); ?>"><h3> <?php echo	resumen(get_the_title(), 19, false); ?></h3></a> -->
<?php // endif ?>

<?php

ob_start();
	wc_get_template( 'loop/price.php' );
	$precioGral = ob_get_contents();
ob_end_clean();

for ($i=0; $i < count($available_variations) ; $i++) {

/*	if (empty($available_variations[$i]['variation_description'])) {
		$available_variations[$i]['variation_description']= '<p>'.get_the_content().'</p>';
	}
	preg_match("/<p[^>]*>(.*?)<\\/p>/si", $available_variations[$i]['variation_description'], $match);

	$content = '<p>'.resumen($match[1], 19, false).'</p>';

	$available_variations[$i]['variation_description_corta'] = $content;*/
	$available_variations[$i]['image_title'] = get_the_title();

	if ($available_variations[$i]['price_html'] === '' )
		$available_variations[$i]['price_html'] = $precioGral;

}

$galeriasDeVariciones = array();

foreach ($available_variations as $variacion){

	$strIdImagenes = get_post_meta( $variacion['variation_id'] , '_variation_image_gallery', true );
	$arrIdImagenes = explode(',', $strIdImagenes);

	$galeriasDeVariciones['galeria-'.$variacion['variation_id']] = array();

	foreach ($arrIdImagenes as $id){
		array_push( $galeriasDeVariciones['galeria-'.$variacion['variation_id']], wp_get_attachment_image_src( $id, 't768'));

	};
}; 

?>
<script type="text/javascript">
	if (jQuery.isEmptyObject(galeriasDeVariciones)){
		galeriasDeVariciones = <?php echo json_encode($galeriasDeVariciones);?>
	}
</script>

<form class="MODIFICADO variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>



		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr <?php echo $retVal = ($attribute_name === 'pa_color' && !is_product()) ? 'class="oculto"' : '';  ?>>
						<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
						<td class="value">
							<?php
								$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );
								wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
								echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( 'Clear', 'woocommerce' ) . '</a>' ) : '';
							?>
						</td>
					</tr>
		        <?php endforeach;?>
			</tbody>
		</table>

		<?php if (is_product()): ?>
			<div class="switchColorPanel">
				<!-- <div id="scroll-down" class="scrollStep scrollStep_down" data-target="#listaColores">down</div>
				<div id="scroll-up" class="scrollStep scrollStep_up" data-target="#listaColores">up</div> -->
				<div id="listaColores">
					<?php
					if( $product->product_type == 'variable'){

						$available_variations = $product->get_available_variations();

						//print_r($available_variations);
						$colorLeido = array();

						$variacionesOredenadas = $available_variations;


						usort($variacionesOredenadas, "comparaVid");

						foreach( $variacionesOredenadas as $variation => $value){
							if(!in_array($value['attributes']['attribute_pa_color'], $colorLeido) ){

								echo '<img class="switchColor" data-id="'.$value['variation_id'].'" data-pregrande="'.wp_get_attachment_image_src(get_post_thumbnail_id( $value['image-id']), 'shop_single')[0].'" data-select="' . $value['attributes']['attribute_pa_color'] . '" data-size="' . $value['attributes']['attribute_pa_size'] . '" src="' . wp_get_attachment_image_src(get_post_thumbnail_id( $value['image-id']), 't43')[0] .'">';

							}
							array_push($colorLeido,$value['attributes']['attribute_pa_color']);
						}
					}
					?>
				</div>
			</div>
		<?php endif ?>

		<div class="<?php if (!is_product()) echo 'oculto'  ?>">
			<?php woocommerce_single_variation(); ?>
		</div>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>



		<div class="single_variation_wrap MODIFICADO">
			<?php
				/**
				 * woocommerce_before_single_variation Hook.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				//do_action( 'woocommerce_single_variation' );



				woocommerce_single_variation_add_to_cart_button();



				/**
				 * woocommerce_after_single_variation Hook.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
