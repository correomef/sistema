<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
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
global $opciones, $opcionesArray;
wc_print_notices();
?>

<div class="bordeTuCompra">
	<div class="tituloTuOrden">
		<?php echo idioma('Your Order','Tu Orden','Vossa Ordem'); ?>
		<?php  echo $GLOBALS['q_config']['language']; ?>
		<div class="close">x</div>
	</div>
	<?php
		$cantidad = count(WC()->cart->get_cart());

		$strProductos = ($cantidad > 1 ) ?
			idioma('products', 'productos', '', '', 'noEcho') :
			idioma('product', 'producto', '', '', 'noEcho');
	 ?>
	 <?php if ($cantidad !=0): ?>
		<p><?php idioma('You have loaded ' . $cantidad . ' ' . $strProductos. ' in your order','Tienes cargado ' . $cantidad . ' ' . $strProductos. ' en tu pedido',''); ?></p>
	 <?php endif ?>

	<?php do_action( 'woocommerce_before_mini_cart' ); ?>

	<ul class="cart_list product_list_widget <?php echo $args['list_class']; ?>">

		<?php if ( ! WC()->cart->is_empty() ) : ?>



			<?php

				/*if (isset($_POST['borrar'])) {
					echo $_POST['key'];
					WC()->cart->set_quantity($_POST['key'],0);
				}*/

				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {





					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					$idProductoEnCarro = ( $_product->variation_id) ? $_product->variation_id : $product_id;



					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

						$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
						$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
						<li class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
							<?php
							/*echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
								esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );*/
							?>

							<?php if ( ! $_product->is_visible() ) : ?>
								<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;'; ?>
							<?php else : ?>
								<!-- <a href="<?php //echo esc_url( $_product->get_permalink( $cart_item ) ); ?>"><?php //echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;'; ?></a>  -->
								<div class="celda">
								<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
									<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
								</a>
							</div>
							<?php endif; ?>

							<div class="celda nombre-ProductoMiniCarrito">
								<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>" title="<?php echo $product_name ?>"><?php echo $product_name ?></a>
								<div class="codigo"><?php echo idioma('Product code','Código de Producto: ','Código do produto').$_product->get_sku(); ?></div>
								<div class="talleCantidad">
									<?php echo WC()->cart->get_item_data( $cart_item ); ?>

									<div>
										<span><?php idioma('Quantity: ','Cantidad: ','Quantidade: '); ?></span>
										<!-- <select name="cantidad" id="cantidad">
											<?php for ($i=0; $i < $_product->get_stock_quantity(); $i++) { ?>
												<option value="<?php echo $i ?>"><?php echo $i ?></option>
											<?php } ?>
										</select> -->
										<span name="cantidad" id="cantidad"><?php echo $cart_item['quantity'] ?></span>

									</div>
								</div>

								<?php// echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
								<div id="subtotalProductoMiniCarrito">
									<!-- <span class="MiniCarrito-cantidadPorPrecio"><?php // echo $cart_item['quantity'] ?> x <?php // echo $product_price ?></span> -->

									<span class="MiniCarrito-totalProducto"><span class="moneda">$</span><?php echo $cart_item['line_total'] ?><span>
								</div>

							</div>

							<button type="submit" data-key = "<?PHP echo $cart_item_key;?>" data-product_id="<?php echo $idProductoEnCarro ?>" data-product_sku="<?php echo $_product->get_sku() ?>" data-quantity="0" data-borrar="borrar" class="add_to_cart_button button product_type_simple remove ajax_add_to_cart"><?php echo idioma('Delete Product','Eliminar Producto','Remover o Produto'); ?></button>

						</li>
						<?php
					}
				}
			?>



	<?php else: ?>
		<li class="empty"><?php idioma('No items loaded on your order','No tienes productos cargados en tu pedido','Não tem itens carregados na sua encomenda'); ?></li>
	<?php endif; ?>

	</ul><!-- end product list -->

	<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>


		<?php  $subtotal = floatval( preg_replace( '#[^\d.]#', '', WC()->cart->get_cart_subtotal() ) );//woocomerceSpanAnumero( WC()->cart->get_cart_subtotal(), false ) // subtotal sin formato pata script?>
		<?php

		if (key_exists('CarroDeCompras-valorEnvioGratis', $opciones) && is_numeric($opciones['CarroDeCompras-valorEnvioGratis'])) {
			$EG = $opciones['CarroDeCompras-valorEnvioGratis'];
		}else{
			$EG ="noDefinido";
		}?>
		<script>
			if ($('#shipping_metodoEnvio_field input').length) {

				$('#envioMiniCarritoContenedor').fadeIn('fast');
				tipoEnvio = $('#shipping_metodoEnvio_field input').val().split('-');
				subtotal = <?php echo $subtotal; ?>;
				envioGratis = <?php echo '"'.$EG.'"'; ?>;

				if (subtotal >= envioGratis && envioGratis !== 'noDefinido'){
					costoEnvio = 0;
				}else{
					costoEnvio = tipoEnvio[0];
				}

				console.log(costoEnvio);

				$('#envioMiniCarrito').html('<span>Envio: $'+costoEnvio+'</span>');
				sumaTotal = parseFloat(subtotal) + parseFloat(costoEnvio);
				$('#subtotalMasEnvioMiniCarrito').html( '$'+sumaTotal );
			}

		</script>
		<?php if (is_page('mi-compra')): ?>
			<div id="MiniCarrito-Subtotal">Sub.: <?php echo WC()->cart->get_cart_subtotal(); ?> <?php _e( 'ARS', 'woocommerce' ); ?></div>
		<?php endif ?>


		<div id="envioMiniCarritoContenedor" style="display:none"><span id="envioMiniCarrito"></span> <span><?php _e( 'ARS', 'woocommerce' ); ?></span></div>

		<div id="totalMiniCarrito">
			<?php _e( 'Total', 'woocommerce' ); ?>: <span id="subtotalMasEnvioMiniCarrito"> <?php echo WC()->cart->get_cart_total(); ?></span><span> <?php _e( 'ARS', 'woocommerce' ); ?></span>
		</div>




		<?php if (!is_page('mi-compra')): ?>
			<a class="add_to_cart_button" href="<?php echo $aMiCompra = (WC()->cart->get_cart_contents_count() > 0) ? get_bloginfo("url").'/mi-compra' : '#' ?>"><?php idioma('Buy','Comprar','Comprar'); ?></a>
		<?php endif ?>

		<script type="text/javascript">
			$('.abreModal').click(function(e) {
			    e.preventDefault();
			    var modalID = $(this).attr('data-modal');
			    var modal = $(modalID);
			    var trancicion = 'fadeIn';

			    if (typeof(modal.attr('data-transicion')) !== 'undefined') {
			        trancicion = modal.attr('data-transicion');
			    }else{
			        modal.attr('data-transicion','fadeIn');
			    }

			    $('.abreModal').each(function(eq) {
			        modalaOcultar = $($(this).attr('data-modal'));
			        if (typeof(modalaOcultar.attr('data-transicion')) !== 'undefined') {
			            modalaOcultar.removeClass(modalaOcultar.attr('data-transicion'));
			        } else{
			            if (modalaOcultar.hasClass('fadeIn')){
			                modalaOcultar.removeClass('fadeIn');
			            }
			        }
			        $(modalaOcultar).css({
			            'display': 'none'
			        });
			        $('.fondoModal').remove();
			    });


			    $('body').append('<div class="fondoModal"></div>');

			    $('.fondoModal').fadeIn(700, function() {
			        if ($(window).height() > modal.outerHeight()) {
			            top2 = ($(window).height() / 2) - (modal.outerHeight() / 2) + $(document).scrollTop();
			        } else {
			            top2 = 40 + $(document).scrollTop();

			        }
			        left2 = ($(window).width() / 2) - (modal.outerWidth(true) / 2);
			        modal.css({
			            'top': top2,
			            'left': left2
			        });
			        modal.addClass(trancicion);
			    });

			    $('.close, .fondoModal').click(function() {
			        modal.removeClass(trancicion);
			        modal.fadeOut(700, function() {
			            $('.fondoModal').fadeOut(700, function() {
			                $('.fondoModal').remove();
			            });
			        });
			    });
			});

		</script>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_mini_cart' ); ?>

	<!-- <div class="ofertaMiniCart">
		    <?php
		    $args = array(
		      'post_type' => 'product',
		      'meta_key' => '_featured',
		      'posts_per_page' => 1,
		      'columns' => '3',
		      'meta_value' => 'yes'
		      );

		      $loop = new WP_Query( $args ); ?>

		        <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>

		            <div class="images">
	            			<?php $imgDestacada = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID), 't320')[0]; ?>

	            			<a href="<?php echo get_the_permalink() ?>"> <img data-bp="bp3" data-imgGrande="<?php echo $imgDestacada ?>" title ="<?php echo get_the_title() ?>" alt="<?php echo get_the_title() ?>" src="<?php echo $imgDestacada ?>"></a>
	            		</div>
					<div class="info">
	            		<a href="<?php echo get_the_permalink() ?>" title="<?php echo get_the_title()?> "><h3><?php echo get_the_title(); ?></h3></a>

						<a href="<?php the_permalink(); ?>" class="verMas"><?php idioma('See More','Ver Mas','Ver mais'); ?></a>

						<div data-product_id="<?php echo $product->id ?>" data-product_sku="<?php echo $product->get_sku() ?>" data-quantity="1" class="single_add_to_cart_button button alt add_to_cart_button ajax_add_to_cart"><?php idioma('+ Add to cart','+ Agregar a carrito','+ Adicionar à carrito',''); ?> <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 23" enable-background="new 0 0 24 23" xml:space="preserve"> <path fill="#fff" id="svg_1" d="M22.7,2.5c0.4,0,0.7,0.1,0.9,0.4c0.3,0.3,0.4,0.6,0.3,1l-1.3,8.7c0,0.3-0.2,0.5-0.4,0.7 c-0.2,0.2-0.5,0.3-0.8,0.3H7.4l0.2,1.3h12.6c0.3,0,0.6,0.1,0.9,0.4s0.4,0.5,0.4,0.9s-0.1,0.6-0.4,0.9c-0.2,0.2-0.5,0.4-0.9,0.4H6.5 c-0.3,0-0.6-0.1-0.8-0.3c-0.2-0.2-0.4-0.4-0.4-0.7L3,2.5H1.3c-0.3,0-0.6-0.1-0.9-0.4S0,1.6,0,1.3s0.1-0.6,0.4-0.9S0.9,0,1.3,0H4 c0.3,0,0.6,0.1,0.8,0.3S5.2,0.7,5.3,1l0.3,1.4C5.5,2.5,22.7,2.5,22.7,2.5z M21.3,5h-4.8v2.5h4.4C20.9,7.5,21.3,5,21.3,5z M15.2,5 h-3.7v2.5h3.7C15.2,7.5,15.2,5,15.2,5z M15.2,8.7h-3.7v2.5h3.7V8.7z M10.3,5H5.9l0.4,2.5c0,0,0.1,0,0.2,0h3.7V5z M6.5,8.7L7,11.2 h3.3V8.7H6.5z M16.5,11.2h3.9l0.3-2.5h-4.2V11.2z M6.5,20.5c0-1.2,0.6-1.9,1.9-1.9c1.3,0,1.9,0.6,1.9,1.9c0,1.3-0.6,1.9-1.9,1.9 C7.2,22.4,6.5,21.8,6.5,20.5z M17.7,20.5c0-1.2,0.6-1.9,1.9-1.9c1.3,0,1.9,0.6,1.9,1.9c0,1.3-0.6,1.9-1.9,1.9 C18.3,22.4,17.7,21.8,17.7,20.5z"></path> </svg></div>

					</div>

		        <?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
	</div> -->
	<?php if (key_exists('CarroDeCompras-ofertaMiniCarrito-html',$opciones)):?>
		<div class="ofertaMinicarrito">
			<?php echo $opciones['CarroDeCompras-ofertaMiniCarrito-html']; ?>
		</div>
	<?php endif;?>


</div>