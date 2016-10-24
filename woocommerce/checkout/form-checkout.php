<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

global $opciones;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() );


?>



<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">

			<ul class="options_tabs ui-tabs-nav" role="tablist" id="TabNav">
				<li class="1"><a href="#" class="active" id="contacto"><span class="numerosTab">1</span> <?php idioma ('CONTACT DATA','DATOS DE CONTACTO','DADOS DE CONTATO','KONTAKT DATEN' ) ?></a></li>
				<li class="2"><a href="#" id="envio"><span class="numerosTab">2</span> <?php idioma ('METHOD INFORMATION','METODOS DE ENVIO','DADOS DE ENVIO','VERSANDDATEN' ) ?></a></li>
				<li class="3"><a href="#" id="medioDePago"><span class="numerosTab">3</span> <?php idioma ('PAY METHOD','MEDIOS DE PAGO','MEIOS DE PAGAMENTO','PAY METHODE' ) ?></a></li>
				<li class="4"><a href="#" id="confirmacion"><span class="numerosTab">4</span> <?php idioma ('CONFIRMATION','CONFIRMACION','CONFIRMAÇÃO','BESTÄTIGUNG' ) ?></a></li>
			</ul>


			<div class="block ui-tabs-panel active" id="option-contacto">
				<h2><?php idioma ('CONTACT DATA','DATOS DE CONTACTO','DADOS DE CONTATO','KONTAKT DATEN' ) ?></h2>
				<div ><!-- class="col-1" -->
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>
				<div class="footerTabPanel">
					<img class="botonEimagen" src="<?php echo get_bloginfo('template_url') ?>/img/icons-seguridad-miCompra.jpg">

						<div class="continuar botonGeneral"><?php idioma('Continue','Continuar','continuar','Fortsetzen'); ?></div>

				</div>

			</div>
			<div class="block ui-tabs-panel" id="option-envio" style="display:none">


				<div><!-- class="col-2" -->
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
				<div class="footerTabPanel">

					<div data-direccion="anterior" class="continuar botonGeneral"><?php idioma('Previous','Anterior','Anterior','Früher'); ?></div>

					<img class="botonEimagen" src="<?php echo get_bloginfo('template_url') ?>/img/icons-seguridad-miCompra.jpg">

					<div class="continuar botonGeneral"><?php idioma('Continue','Continuar','continuar','Fortsetzen'); ?></div>

				</div>
			</div>

			<div class="block ui-tabs-panel" id="option-confirmacion" style="display:none">


				<div id="datosRecopilados">

					<div id="dR-Contacto">
						<h2> <?php idioma('My contact information','Mis Datos de Contacto','Minhas informações de contato','Meine Kontaktdaten'); ?></h2>
						<div class="margen">
							<div id="dR-nombre"></div>
							<div id="dR-dni"></div>
							<div id="dR-email"></div>
							<div id="dR-tel"></div>
						</div>
						<div class="cambiar margen" data-tab="#contacto"><?php idioma('Change','Cambiar','Alterar','Veränderung'); ?></div>
					</div>

					<div id="dR-medioDePago">
						<h2><?php idioma('Payment Method chosen', 'Medio de Pago elegido','Método de pagamento escolhido','Zahlungsmethode gewähl'); ?></h2>
						<div id="dR-mdp-mercadopago" class="margen" >
							<span>MERCADO PAGO</span><span><img src="<?php echo plugins_url(); ?>/woocommerce-mercadopago/images/mercadopago.png" alt=""></span>
						</div>

						<div id="dR-mdp-transferencia" >



							<h4><?php idioma('Wire transfer or Deposit','Transferencia o Deposito','Transferência ou depósito','Überweisung oder Einzahlung'); ?></h4>
							<div class="margen">
								<?php if ($opciones['CarroDeCompras-datosBanco-titular']): ?>
									<p>
										<span><?php idioma('Holder','Titular','Titular','Halter'); ?>: </span>
										<span><?php echo $opciones['CarroDeCompras-datosBanco-titular'] ?></span>
									</p>
								<?php endif ?>

								<?php if ($opciones['CarroDeCompras-datosBanco-Nombre_Del_Banco']): ?>
									<p>
										<span><?php idioma('Bank Name','Nombre del Banco','Nome do Banco','Bank Name'); ?>: </span>
										<span><?php echo $opciones['CarroDeCompras-datosBanco-Nombre_Del_Banco'] ?></span>
									</p>
								<?php endif ?>
								<?php if ($opciones['CarroDeCompras-datosBanco-tipo']): ?>
									<p>
										<span><?php idioma('Account Type','Tipo de Cuenta','Tipo de conta','Kontotyp'); ?>: </span>
										<span><?php echo $opciones['CarroDeCompras-datosBanco-tipo'] ?></span>
									</p>
								<?php endif ?>
								<?php if ($opciones['CarroDeCompras-datosBanco-Numero_De_Cuenta']): ?>
									<p>
										<span><?php idioma('Account N°','N° de Cuenta','N° de conta','N° Konto'); ?><?php _e('','woocommerce') ?>: </span>
										<span><?php echo $opciones['CarroDeCompras-datosBanco-Numero_De_Cuenta'] ?></span>
									</p>
								<?php endif ?>
								<?php if ($opciones['CarroDeCompras-datosBanco-CBU']): ?>
									<p>
										<span><?php _e('CBU','woocommerce') ?>: </span>
										<span><?php echo $opciones['CarroDeCompras-datosBanco-CBU'] ?></span>
									</p>
								<?php endif ?>

								<?php if ($opciones['CarroDeCompras-datosBanco-CUIT']): ?>
									<p>
										<span><?php _e('CUIT','woocommerce') ?>: </span>
										<span><?php echo $opciones['CarroDeCompras-datosBanco-CUIT'] ?></span>
									</p>
								<?php endif ?>
							</div>
						</div>
						<div class="cambiar margen" data-tab="#medioDePago"><?php idioma('Change','Cambiar','Alterar','Veränderung'); ?></div>
					</div>

					<div id="dR-envioPor">

						<h2><?php idioma ('Shipping Method','Metodo de Envio','Método do Envio','Versandar' ) ?></h2>
						<img src="">
						<div id="sucrsalSelcionada"></div>
						<div class="cambiar margen" data-tab="#envio"><?php idioma('Change','Cambiar','Alterar','Veränderung'); ?></div>
					</div>


					<div id="dR-miDireccion">
						<h2><?php idioma('My address','Mi Dirección','Minha direção','Meine Adresse'); ?></h2>
						<div class="margen">
							<div id="quienRecibe"></div>
							<div id="direccion"></div>
							<div id="numero"></div>
							<div id="ciudad"></div>
							<div id="codigoPosta"></div>
							<div id="provincia"></div>
						</div>
						<div class="cambiar margen" data-tab="#envio"><?php idioma('Change','Cambiar','Alterar','Veränderung'); ?></div>

					</div>


				</div>


				<div class="footerTabPanel">
					<img class="botonEimagen" src="<?php echo get_bloginfo('template_url') ?>/img/icons-seguridad-miCompra.jpg">
					<div class="botonEimagen" id="clonBotonPago" class="celda"></div>
				</div>



			</div>

		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<!-- <h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3> -->

	<?php endif; ?>

	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div class="block ui-tabs-panel" id="option-medioDePago" style="display:none">
		<h2><?php idioma('PAYMENT METHODS','MEDIOS DE PAGO','METODOS DE PAGAMENTO', 'ZAHLUNGSMITTEL') ?></h2>
		<div class="margen">
			<div id="order_review" class="woocommerce-checkout-review-order">
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			</div>
		</div>
		<div class="footerTabPanel">

			<div data-direccion="anterior" class="continuar botonGeneral"><?php idioma('Previous','Anterior','Anterior','Früher'); ?></div>

			<img class="botonEimagen" src="<?php echo get_bloginfo('template_url') ?>/img/icons-seguridad-miCompra.jpg">

			<div class="continuar botonGeneral"><?php idioma('Continue','Continuar','continuar','Fortsetzen'); ?></div>

		</div>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
