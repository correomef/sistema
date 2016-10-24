<?php
/*
Template Name: mi-compra
*/

get_header(); ?>

<?php include ('woocommerce/cabeceras.php') ?>

<div class="fondoGeneral" id="paginaMiCompra">
	<div class="contenedor">
		<div class="tablaCentrada">
			<div class="apretadorMiCompra">

				<div class="celda" <?php if (is_page( 'mi-compra')) echo 'id="miCompra"'; ?>>
					<?php echo do_shortcode('[woocommerce_checkout]'); ?>
				</div>

				<?php if (!is_page('carro')): ?>

					<div class="celda tuOrden">
						<div class="widget woocommerce widget_shopping_cart">
							<div class="widget_shopping_cart_content"></div>
						</div>
					</div>
				<?php endif; ?>


			</div>
		</div>

	</div>
</div>
<?php include('footer.php');?>
