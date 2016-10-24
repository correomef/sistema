
<?php global $opciones, $opcionesArray ?>
<!-- <div class="contenedor">
	<div class="scrollTop">
		<img src="<?php echo get_bloginfo('template_url')?>/img/scrollTop.jpg" alt="ir arriba">
	</div>
</div> -->
<footer>

	<div class="contenedor">

		<div class="flexStrech">


			<div id="footer-seguinos" class="celda">
				<h2><?php idioma('Fallow us','Seguinos','Siga'); ?></h2>
				<p>
					<?php include 'redesSociales.php' ?>
				</p>


				<p><img class="icon-mail" src="<?php echo get_bloginfo('template_url') ?>/img/mail-icono.jpg"> <?php echo $opciones['contacto-mails-formularios'] ?></p>

				<p class="copyRight icon icon-r"><?php idioma('All rights reserved','Todos los derechos reservados','Todos os direitos reservados') ?></p>
			</div>



			<div id="footer-Newsletter" class="celda formulario-newsletter">
				<h2><?php idioma('Newsletter','Newsletter','Newsletter'); ?></h2>

				<div class="encabezado">
					<p><?php idioma('Receive our news in your email','Recibí nuestras novedades en tu email','Receba nossas notícias no seu e-mail'); ?></p>
				</div>
				<form  id="newsInicioForm">

					<input type="hidden" name="mailDestino" value="<?php echo $opciones['contacto-mails-formularios'] ?>">
					<input type="hidden" name="nombreEmpresa" value="<?php echo get_bloginfo('name')?>">
					<input type="hidden" name="suscripcion" value="true">

					<div class="obligatorio">
						<p><input placeholder="<?php idioma('NAME AND LASTNAME','NOMBRE Y APELLIDO','NOME E SOBRENOME'); ?>" type="text" name="Nombre" id="Nombre" ></p>
					</div>

					<div class="obligatorio">
						<p><input placeholder="EMAIL" type="text" name="E_mail" id="E_mail"></p>
					</div>

					<div type="submit" class="send"> <?php idioma('Send','Enviar','Enviar') ?></div>

					<div class="enviar clearfix">

						<div class="estado" id="estado" class="bloque">

							<div class="error" id="err-form"></div>

							<div class="error" id="err-timedout">Error de conexión. Intente nuevamente.</div>

							<div class="error" id="err-state"></div>

							<div id="ajaxsuccess"><?php idioma('Your message has been sent!!','Su mensaje ha sido enviado!!','Sua mensagem foi enviado!!') ?></div>

						</div>

					</div>

				</form>
			</div>

			<div id="footer-miCuenta" class="celda">
				<h2><?php idioma('My Acount','Mi Cuenta','Minha conta'); ?></h2>

				<?php if ( is_user_logged_in() ) : ?>
					<a class="modalRegistroUsuario" title="<?php idioma('Welcome','Bienvenido ','Bem-vindo'); ?>: <?php echo $current_user->display_name ?>" href="<?php echo wp_logout_url( home_url() ); ?>"> <?php idioma('Logout','Cerrar Sesión','Terminar sessão'); ?> </a>
				<?php endif; ?>

				<?php if ( !is_user_logged_in() ) : ?>
					<a href="#"><p id="iniciaSeccionFooter"><?php idioma('Login','Iniciar Sesión','Iniciar sessão'); ?></p></a>
				<?php endif; ?>

				<?php if ( !is_user_logged_in() ) : ?>
					<a href="#"><p class="abreRegitro" data-modal="#formRegistro"><?php idioma('Register','Registrarte','Register'); ?></p></a>
				<?php endif; ?>

				<a href="<?php echo get_bloginfo('url') ?>/terminos-de-privacidad/"><p><?php idioma('Terms Privacy','Términos de Privacidad','Termos de Privacidade'); ?></p></a>
			</div>

			<div id="footer-RPMCROSS" class="celda DesapareceEnMovil">
				<h2><?php echo bloginfo('name'); ?></h2>

				<a href="<?php echo get_bloginfo('url') ?>/contacto/"><p><?php idioma('Contact','Contacto','Contacto'); ?></p></a>
				<a href="<?php echo get_bloginfo('url') ?>/legal/"><p><?php idioma('Legal','Legal','Legal'); ?></p></a>
			</div>

			<?php if ($opciones['pieDePagina-DataFiscal-imagen-img']): ?>
				<div id="footer-datafiscal" class="celda">
					<h2><?php idioma('Tax Data','Data Fiscal','Dados Fiscal'); ?></h2>

					<?php if ($opciones['pieDePagina-DataFiscal-link']): ?>
						<a target="_blank" href="<?php echo $opciones['pieDePagina-DataFiscal-link']?>">
						<?php endif ?>

						<img class="datafiscal" data-imgCel="" data-imgGrande="<?php echo $opciones['pieDePagina-DataFiscal-imagen-img'] ?>" src="">

						<?php if ($opciones['pieDePagina-DataFiscal-link']): ?>
						</a>
					<?php endif ?>
				</div>
			<?php endif ?>

		</div>

	</div>

	<div class="footerLogos">
		<div class="contenedor">
			<div class="logoFooter">
			<?php if (key_exists('pieDePagina-logoFooter-img',$opciones)): ?>
				<img src="<?php echo $opciones['pieDePagina-logoFooter-img'] ?>" alt="Logo Cuerdos Cloth">
			<?php endif ?>
			</div>
			<div class="logosContedor">

				<?php if ($opcionesArray['pieDePagina']['logosInferiores']): ?>
					<?php foreach ($opcionesArray['pieDePagina']['logosInferiores'] as $logo => $value): ?>
						<?php if ($value['logo']['link']): ?>
							<a href="<?php echo $value['logo']['link'] ?>">
						<?php endif; ?>
							<img src="<?php echo $value['logo']['img'] ?>">
						<?php if ($value['logo']['link']): ?>
							</a>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>


	<div class="firma"><a target="_blank" href="http://monetapizarroestudio.com/"><img class="iconFooter" src="<?php echo get_bloginfo('template_url');?>/img/MP-logo.svg" alt="Moneta Pizarro Estudio">MONETA PIZARRO ESTUDIO</a></div>


</footer>

<div class="modal" id="formRegistro">
	<div class="close">×</div>
	<?php echo do_shortcode('[woocommerce_my_account]'); ?>
</div>


<script src="<?php echo get_bloginfo('template_url');?>/js/main.js"></script>

<?php wp_footer(); ?>
</body>
</html>