<?php
/*
Template Name: gracias
*/
$pagina = 'Gracias';

include('header.php');


 include ('woocommerce/cabeceras.php') ?>



<div id="paginaGracias">
	<main>
		<div class="contenedor">
		<?php if ($opcionesArray['CarroDeCompras']['paginaGracias']): ?>
			<div class="saludo">
				<?php echo $opciones['CarroDeCompras-paginaGracias'] ?>
			</div>
		<?php else: ?>
			<div class="saludo">
				<h2><?php idioma('Congratulations. You have made your purchase.','Felicitaciones. Has realizado tu compra.','Parabéns. Você fez sua compra.','Vielen Dank für Ihren Einkauf !!'); ?></h2>
				<p><?php idioma('You receive an email with all the details of your purchase.','Recibiras un email con todos los detalles de tu compra.','Você receberá um e-mail com todos os detalhes de sua compra.','Die Details kommen, um Ihre E-Mail zu jeder Zeit.'); ?></p>
				<a class="botonGeneral" href="<?php echo get_bloginfo('url')?>/">continuar</a>
			</div>
		<?php endif; ?>
		</div>
	</main>
</div>

<?php include('footer.php');  ?>
