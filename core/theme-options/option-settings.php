<?php global $opcionesArray, $opciones; ?>

<?php

	$modulos = array(

		array(
			// palabra unica id del modulo
			'slug' =>'cabecera',
			// titulo que ve el usuario
			'tiulo' =>'Header',

			'secciones' => array(
				// palabra unica id de la seccion
				'slug' => 'barraPostMenu',
				// titulo que ve el usuario de la seccion
				'titulo' => 'Barra Post Menu',
				// si es vacio se concatena los slug del modulo y de la seccion, a veces solo es necesario el nombre del modulo solamente
				'nombreOpcion' => '',
				// las subsecciones pueden ser dinamicas en el caso de usar las categorias de WP ():
				// get_terms( 'product_cat', $args ) -recordar cambiar guiones medios por guiones bajosd
				//Si es posible "agregar nuevo" declarar el arreglo vacio "array()"
				//si es "unica" el contendor ocupa el 100%
				'subSecciones' => array(
					'unica',
					),
				'parametros' => array(

				),
				'tamanoImagen' => '',
				'textoCabecera' => '',
				'subSecNumeradas' => '',
				'traducir' => '',
				'toggleData' => '',
				'ordenable' => '',
				),
			),

		);
?>

<div class="wrap" id="weblizar_wrap" >

	<div id="content_wrap">

		<div id="content">
			<div id="options_tabs" class="ui-tabs ">
				<ul class="options_tabs ui-tabs-nav clearfix" role="tablist" id="nav">
					<li <?php if ($opciones['moduloActivo'] === '#tabAdmin-cabecera') {
						echo 'class="active"'; }  ?>
						><a href="#" id="tabAdmin-cabecera">Header</a>
					</li>

					<li <?php if ($opciones['moduloActivo'] === '#tabAdmin-inicio') {
						echo 'class="active"'; }  ?>>
						<a href="#" id="tabAdmin-inicio">Pagina Inicio</a>
					</li>

					<li <?php if ($opciones['moduloActivo'] === '#tabAdmin-Cabeceras') {
						echo 'class="active"'; }  ?>>
						<a href="#" id="tabAdmin-Cabeceras">Cabeceras</a>
					</li>

					<li <?php if ($opciones['moduloActivo'] === '#tabAdmin-contacto') {
						echo 'class="active"'; }  ?>>
						<a href="#" id="tabAdmin-contacto" >Contacto</a>
					</li>

					<li <?php if ($opciones['moduloActivo'] === '#tabAdmin-CarroDeCompras') {
						echo 'class="active"'; }  ?>>
						<a href="#" id="tabAdmin-CarroDeCompras">Carro de Compras</a>
					</li>

					<li <?php if ($opciones['moduloActivo'] === '#tabAdmin-avisosLegales') {
						echo 'class="active"'; }  ?>>
						<a href="#" id="tabAdmin-avisosLegales">Avisos Legales</a>
					</li>

					<li <?php if ($opciones['moduloActivo'] === '#tabAdmin-pieDePagina') {
						echo 'class="active"'; }  ?>>
						<a href="#" id="tabAdmin-pieDePagina" >Pie De Pagina</a>
					</li>

					<li <?php if ($opciones['moduloActivo'] === '#tabAdmin-codigoAnalitics') {
						echo 'class="active"'; }  ?>>
						<a href="#" id="tabAdmin-codigoAnalitics" >Codigo Analitics</a>
					</li>
				</ul>

				<!-- <pre><code><?php // print_r(get_option('opcionesBackUp')); ?></code></pre> -->

				<form method="post" id="weblizar_theme_options_general">

					<input type="hidden" value="<?php echo $opciones['moduloActivo']?>" id="moduloActivo" name="moduloActivo">

					<div id="button_section" style="text-align:right;">
						<div class="weblizar_settings_loding" id="weblizar_loding_general_image"></div>
						<div class="weblizar_settings_massage" id="weblizar_settings_save_general_success" >Datos Actualizados</div>
						<input class=" button-primary" type="button" value="Guardar opciones" onclick="weblizar_option_data_save('general')" >

					</div>

					<div class="block ui-tabs-panel <?php if ($opciones['moduloActivo'] === '#tabAdmin-cabecera') {echo 'active'; } else {echo 'deactive'; } ?> " id="option-tabAdmin-cabecera" >

						<?php $modulo = 'cabecera' ?>
						<div class="Conf panel-group" id="accordionL">

							<div class="ConfToggleHead"  data-toggle="collapse" href="#cabecera-logo">
								<h2>Logo Principal</h2>
							</div>

							<div class="section collapse ConfBody" id="cabecera-logo">
								<h2>Logo Principal</h2>
								<input type="hidden" name="logo-id" value="<?php echo $opciones['logo-id'] ?>" />
								<input class="inputUrlImagen" type="text" value="<?php if(array_key_exists('logo', $opciones)) { echo esc_attr($opciones['logo']); } ?>" id="logo" name="logo" size="36" class="upload has-file"/>
								<input type="button" id="upload_button" value="Cambiar Logo" class="upload_image_button" />
								<img style="max-width:493px" src="<?php if(array_key_exists('logo', $opciones)) { echo esc_attr($opciones['logo']); } ?>" />
							</div>

						</div>

						<div class="Conf panel-group">
							<?php
							$seccion = 'barraPostMenu';
							$titulo = 'Barra Post Menu';
							$nombreOpcion = $modulo.'-'.$seccion;
							$subSecciones = array('unica');
							$tamanoImagen ='65px';

							ob_start();?>
							<div class="section">
								<p>Para intoducir codigo HTML clique en la pestaña que se encuentra arriba a la derecha del editor que aparece debajo de estas lineas</p>
							</div>
							<?php
							$textoCabecera = ob_get_clean();

							$subSecNumeradas = false;
							$traducir = true;
							$parametros = array(
								array('nombre' => '', 'tipo' => 'wpEditor', 'traducir' => true),
								);
								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen, $textoCabecera, $subSecNumeradas, $traducir); ?>

						</div>

						<?php
							/*array(
                                'taxonomy'     => 'product_cat',
                                'child_of'     => get_term_by( 'slug', 'coleccion', 'product_cat' )->term_id,
                            );

							$product_categories = get_terms( 'product_cat', $args );
							$nobresCategorias=array();

							foreach( $product_categories as $cat ) {

								$vowels = array("-", " ");
								$espacioOguionAguinBajo = str_replace($vowels, "_", $cat->slug);

								array_push($nobresCategorias, $espacioOguionAguinBajo);
							}*/
						?>
						<!-- <div class="Conf panel-group">
							<?php
							/*$seccion = 'menu-pd';
							$titulo = 'Productos destacados del Menu';
							$nombreOpcion = $seccion;
							$subSecciones = $nobresCategorias;
							$tamanoImagen ='30%';
							$parametros = array(

								array('nombre' => 'link', 'tipo' => 'input'),
								array('nombre' => 'imagen', 'tipo' => 'imagen', 'borrable' => true),

								);
								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen);*/ ?>

						</div> -->




					</div>

					<?php $modulo = 'inicio'; ?>
					<div class="block ui-tabs-panel <?php if ($opciones['moduloActivo'] === '#tabAdmin-'.$modulo) {echo 'active'; } else {echo 'deactive'; } ?> " id="option-tabAdmin-<?php echo $modulo?>" >

						<?php // cargarSlide('Slider de Inicio Principal', $modulo.'-slide', $opcionesArray[$modulo]['slide'], true, 'conLink'); ?>

						<div class="Conf panel-group">
							<?php
								$seccion = 'slider';
								$titulo = 'Slider de Inicio Principal';
								$nombreOpcion = $modulo.'-'.$seccion;
								$tamanoImagen = '100%';
								$textoCabecera = '';
								$parametros = array(
									array('titulo' => 'Imagen del Slide','nombre' =>'imagen', 'tipo' => 'imagen'),
									array('titulo' => 'Titulo', 'nombre' => 'titulo', 'tipo' => 'input', 'traducir' => true),
									array('titulo' => 'Descripcion', 'nombre' => 'descripcion', 'tipo' => 'input', 'traducir' => true),
									array('nombre' =>'link', 'tipo' => 'input'),

									);

								$traducir = '';
								$toggleData = '';
								$ordenable = 'ordenable';
								$subSecNumeradas = true;

								$subSecciones= array();

								if ($opcionesArray[$modulo][$seccion]){
									foreach ($opcionesArray[$modulo][$seccion] as $ID => $value) {
										array_push($subSecciones, $ID);
									}
								}
								else{
									$subSecciones = array('slide_1');
								}

								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen, $textoCabecera, $subSecNumeradas, $traducir, $toggleData, $ordenable);
							?>
						</div>

						<div class="Conf panel-group">
							<?php
							$seccion = 'bannerEntradasFinDeHome';
							$titulo = 'Banner Entradas Fin De Home';
							$nombreOpcion = $modulo.'-'.$seccion;
							$subSecciones = array('unica');
							$tamanoImagen ='100%';

							ob_start();?>

							<?php
							$textoCabecera = ob_get_clean();

							$subSecNumeradas = false;
							$traducir = true;
							$parametros = array(
								array('nombre' => '', 'tipo' => 'imagen'),
								);
								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen, $textoCabecera, $subSecNumeradas, $traducir); ?>

						</div>

					</div>



					<div class="block ui-tabs-panel <?php if ($opciones['moduloActivo'] === '#tabAdmin-Cabeceras') {echo 'active'; } else {echo 'deactive'; } ?> " id="option-tabAdmin-Cabeceras" >

						<?php $modulo = 'cabeceras';

						$args = array(
							'number'     => $number,
							'orderby'    => $orderby,
							'order'      => $order,
							'hide_empty' => $hide_empty,
							'include'    => $ids
							);

						$product_categories = get_terms( 'product_cat', $args );
						$nobresCategorias=array();

						foreach( $product_categories as $cat ) {

							$vowels = array("-", " ");
							$espacioOguionAguinBajo = str_replace($vowels, "_", $cat->slug);

							array_push($nobresCategorias, $espacioOguionAguinBajo);
						}
						sort($nobresCategorias);

						unset($nobresCategorias[array_search('destacado_en_menu', $nobresCategorias)]);
						?>


						<div class="Conf panel-group">
							<?php
							$seccion = '';
							$titulo = 'Cabeceras De Categorias De Productos';
							$nombreOpcion = $modulo;
							$subSecciones = $nobresCategorias;
							$tamanoImagen ='100%';
							$parametros = array(

								array('nombre' => 'meta_title', 'tipo' => 'input', 'traducir' => true),
								array('nombre' => 'meta_description', 'tipo' => 'textarea', 'traducir' => true),
								array('nombre' => 'imagen', 'tipo' => 'imagen', 'borrable' => true),

								);
								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen); ?>

						</div>


						<?php $paginasConCabeceras = array('media', 'catalogo','locales', 'mi_compra', 'mails','gracias', 'contacto', 'team'); ?>

						<div class="Conf panel-group">
							<?php
							$seccion = '';
							$titulo = 'Cabeceras De Paginas';
							$nombreOpcion = $modulo;
							$subSecciones = $paginasConCabeceras;
							$tamanoImagen ='100%';
							$textoCabecera ='';
							$subSecNumeradas ='';
							$traducir ='';
							$toggleData ='cabecerasDePaginas';
							$parametros = array(
								array('nombre' => 'meta_title', 'tipo' => 'input', 'traducir' => true),
								array('nombre' => 'meta_description', 'tipo' => 'textarea', 'traducir' => true),
								array('nombre' => 'imagen', 'tipo' => 'imagen', 'borrable' => true),

								);
								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen, $textoCabecera, $subSecNumeradas, $traducir, $toggleData); ?>

						</div>


					</div>


					<?php $modulo = 'contacto'; ?>
					<div class="block ui-tabs-panel <?php if ($opciones['moduloActivo'] === '#tabAdmin-'.$modulo) {echo 'active'; } else {echo 'deactive'; } ?>" id="option-tabAdmin-<?php echo $modulo;?>" >

						<div class="Conf panel-group">
							<?php
							$seccion = 'mails';
							$titulo = 'Mails';
							$nombreOpcion = $modulo.'-'.$seccion;
							?>
							<div class="ConfToggleHead"  data-toggle="collapse" href="#<?php echo $nombreOpcion?>">
								<h2><?php echo $titulo ?></h2>
							</div>

							<div class="section collapse ConfBody" id="<?php echo $nombreOpcion ?>">


								<h2>Recepcion Formularios</h2>

								<?php $subSeccion = 'formularios'; ?>

								<input class="weblizar_inpute"  type="text" name="<?php echo $nombreOpcion.'-'.$subSeccion ?>" id="<?php echo $nombreOpcion.'-'.$subSeccion?>" value="<?php echo $opciones[$nombreOpcion.'-'.$subSeccion]; ?>" >
								<div class="leyendaAyuda">
									<p>Al que queres que lleguen las consultas hechas por los formulario de contacto</p>
								</div>

								<h2>Recepcion Pedidos</h2>

								<?php $subSeccion = 'pedidos'; ?>

								<input class="weblizar_inpute"  type="text" name="<?php echo $nombreOpcion.'-'.$subSeccion ?>" id="<?php echo $nombreOpcion.'-'.$subSeccion?>" value="<?php echo $opciones[$nombreOpcion.'-'.$subSeccion]; ?>" >
								<div class="leyendaAyuda">
									<p>Al que queres que lleguen los avisos de pedidos de tu carrito de compras</p>
								</div>

							</div>

						</div>


						<div class="Conf panel-group">
							<?php
								$seccion = 'sociales';
								$titulo = 'Redes Sociales';
								$nombreOpcion = $modulo.'-'.$seccion;
								$tamanoImagen = '40px';
								$textoCabecera = '';
								$parametros = array(
									array('titulo' => 'Nombre de la Red Social', 'nombre' => 'nombreRed', 'tipo' => 'input', 'traducir' => false),
									array('titulo' => 'Nombre de tu cuenta', 'nombre' => 'nombreCuenta', 'tipo' => 'input', 'traducir' => false),
									array('nombre' =>'link', 'tipo' => 'input'),
									array('nombre' =>'icono', 'tipo' => 'imagen'),

									);

								$traducir = '';
								$toggleData = '';
								$ordenable = 'ordenable';
								$subSecNumeradas = true;

								$subSecciones= array();

								if ($opcionesArray[$modulo][$seccion]){
									foreach ($opcionesArray[$modulo][$seccion] as $ID => $value) {
										array_push($subSecciones, $ID);
									}
								}
								else{
									$subSecciones = array('red_Social_1');
								}

								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen, $textoCabecera, $subSecNumeradas, $traducir, $toggleData, $ordenable);
							?>
						</div>

						<div class="Conf panel-group">
							<?php
							$seccion = 'postal';
							$titulo = 'Postal';
							$nombreOpcion = $modulo.'-'.$seccion;
							$subSecciones = array('unica');
							$parametros = array(
								array('nombre' => 'direccion', 'tipo' => 'input'),
								array('nombre' => 'ciudad', 'tipo' => 'input'),
								array('nombre' => 'provincia', 'tipo' => 'input'),
								array('nombre' => 'pais', 'tipo' => 'input'),
								);
								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen); ?>

						</div>

						<div class="Conf panel-group">
							<?php
							$seccion = 'telefonos';
							$titulo = 'Telefonos';
							$nombreOpcion = $modulo.'-'.$seccion;
							$subSecciones = array('unica');
							$parametros = array(
								array('nombre' => '', 'tipo' => 'input'),
								);
								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen); ?>

						</div>
						<div class="Conf panel-group">
							<?php
							$seccion = 'coordenadas';

							$titulo = 'Ubicacion mapa pagina Contacto';
							$nombreOpcion = $modulo.'-'.$seccion;

							 ob_start();?>
							<!--  <h2>PARAM MODIFICAR</h2>
							<ol style="list-style-type: ">
								<li>Ingrese a <a target="_blank" href="https://www.google.com.ar/maps">https://www.google.com.ar/maps</a></li>
								<li>Siga los pasos de la imagen</li>
								<li>Copie el contenido en el campo de titulo "CODIGO" debajo de la imagen</li>
							</ol>
														<p>
															<a target="_blank" href="https://www.google.com.ar/maps"><img style="width: 50%; display: block" src="<?php echo get_bloginfo('template_url')?>/img/ayudas/googlemap.jpg"></a>
														</p> -->
							<?php
								$textoCabecera = ob_get_clean();
							$tamanoImagen = '30%';
							$subSecciones = array('unica');
							$subSecNumeradas = false;
							$traducir = false;
							$parametros = array(
								array('nombre' => 'coordenadas', 'tipo' => 'mapa'),
								);
							cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen, $textoCabecera, $subSecNumeradas, $traducir); ?>

						</div>

					</div>

					<div class="block ui-tabs-panel <?php if ($opciones['moduloActivo'] === '#tabAdmin-CarroDeCompras') {echo 'active'; } else {echo 'deactive'; } ?>" id="option-tabAdmin-CarroDeCompras" >

						<?php $modulo = 'CarroDeCompras'; ?>
						<div class="Conf panel-group">
							<?php
								$seccion = 'metodosDeEnvio';
								$titulo = 'Metodos de Envio';
								$nombreOpcion = $modulo.'-'.$seccion;
								$tamanoImagen = '250px';
								$textoCabecera = '';
								$parametros = array(
									array('nombre' => 'nombre', 'tipo' => 'input', 'traducir' => true),
									array('nombre' =>'imagen', 'tipo' => 'imagen', 'borrable' => true),
									array('nombre' =>'costo', 'tipo' => 'input', 'controlComas' => true),
									array('nombre' =>'tiempo', 'tipo' => 'input', 'traducir' => true),
									array('nombre' =>'descripcion', 'tipo' => 'input', 'traducir' => true),
									array('nombre' =>'volumen', 'tipo' => 'input', 'traducir' => true),
									array('nombre' =>'sucursales', 'tipo' => 'textarea'),
									array('nombre' =>'solicita_datos_de_envio', 'tipo' => 'activacion', 'valueOn' => 'si', 'valueOff'=>'eliminarCampo'),
									);
								$subSecNumeradas = true;
								$subSecciones= array();

								if ($opcionesArray[$modulo][$seccion]){
									foreach ($opcionesArray[$modulo][$seccion] as $ID => $value) {
										array_push($subSecciones, $ID);
									}
								}
								else{
									$subSecciones = array('metodo_1');
								}

								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen, $textoCabecera, $subSecNumeradas);
							?>
						</div>

						<div class="Conf panel-group">
							<?php
								$seccion = 'valorEnvioGratis';
								$titulo = 'Valor Envio Gratis';
								$nombreOpcion = $modulo.'-'.$seccion;
								$tamanoImagen = '250px';
								$textoCabecera = 'Valor a partir del cual el envio no se cobra';
								$parametros = array(
									array('nombre' => '', 'tipo' => 'input', 'controlComas' => true),
									);
								$subSecciones = array('unica');
								$subSecNumeradas = false;
								if ( $subSecciones[0] !== 'unica' ) {
									foreach ($opcionesArray[$modulo][$seccion] as $ID => $value) {
										array_push($subSecciones, $ID);
									}
								}
								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen, $textoCabecera, $subSecNumeradas);
							?>
						</div>

						<div class="Conf panel-group">
							<?php
								$seccion = 'datosBanco';
								$titulo = 'Datos Bancarios';
								$nombreOpcion = $modulo.'-'.$seccion;
								$tamanoImagen = '250px';
								$parametros = array(
									array('nombre' => 'titular', 'tipo' => 'input'),
									array('nombre' =>'Nombre_Del_Banco', 'tipo' => 'input'),
									array('nombre' =>'tipo', 'tipo' => 'input'),
									array('nombre' =>'Numero_De_Cuenta', 'tipo' => 'input'),
									array('nombre' =>'CBU', 'tipo' => 'input'),
									array('nombre' =>'CUIT', 'tipo' => 'input'),
									);
								$subSecciones = array('unica');

								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen);
							?>
						</div>
						<div class="Conf panel-group">
							<?PHP ob_start();?>
							<div class="parametro">
								<h2>Pasos para integrar MercadoPago</h2>
								<h3>PASO 1 </h3>
								<p>Logueate en MercadoPago</p>
								<a style="color:#000" target="_blank" href="https://www.mercadopago.com.ar/">https://www.mercadopago.com.ar/</a>
								<h3>PASO 2 </h3>
								<p>entra a <a style="color:#000" target="_blank" href="https://www.mercadopago.com/mla/herramientas/notificaciones">https://www.mercadopago.com/mla/herramientas/notificaciones</a>

								<h3>PASO 3</h3>
								<p>en URL para notificación pega esta direccion:<br>
								<?php echo bloginfo('url'); ?>/?wc-api=WC_MercadoPago_Gateway

								<h3>PASO 4</h3>
								<p>por ultimo, Introduce los siguientes datos que los encontras en la siguiente dirección: <br>
									<a style="color:#000" target="_blank" href="https://www.mercadopago.com/mla/herramientas/aplicaciones">https://www.mercadopago.com/mla/herramientas/aplicaciones</a>
								</p>
							</div>
							<?php
								$textoCabecera = ob_get_clean();
								$seccion = 'datosMercadoPago';
								$titulo = 'Datos Mercado Pago';
								$nombreOpcion = $modulo.'-'.$seccion;
								$tamanoImagen = '250px';

								ob_start();?>
								Activa el modo de prueba para este metodo de pago. Podes Encontrar datos de prueba en el siguiente enlace: <a style="color:#000" target="_blank" href="https://www.mercadopago.com.ar/developers/es/solutions/payments/custom-checkout/test-cards/">https://www.mercadopago.com.ar/developers/es/solutions/payments/custom-checkout/test-cards/</a>
								<?php
								$DescripcionSandBox = ob_get_clean();

								$parametros = array(
									array(
										  'titulo' => 'Activar Mercado Pago',
										  'nombre' =>'estado',
										  'tipo' => 'activacion',
										  'valueOn' => 'yes',
										  'valueOff'=>'no'
										  ),
									array('nombre' => 'Client_id', 'tipo' => 'input'),
									array('nombre' =>'Client_secret', 'tipo' => 'input'),
									array('nombre' =>'sandbox',
										  'tipo' => 'activacion',
										  'valueOn' => 'yes',
										  'valueOff'=>'no',
										  'titulo' => 'Modo Prueba', 'descripcion' => $DescripcionSandBox),
									);
								$subSecciones = array('unica');
								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen, $textoCabecera);
							?>
						</div>

						<div class="Conf panel-group">
							<?PHP ob_start();?>
							<div class="parametro">
								<h2>Pasos para integrar TodoPago</h2>
								<h3>PASO 1 </h3>
								<p>Logueate en TodoPago</p>
								<a style="color:#000" target="_blank" href="http://todopago.com.ar/">http://todopago.com.ar/</a>

								<h3>PASO 2</h3>
								<p>por ultimo, Introduce los siguientes datos que los encontras en la pestaña COMERCIOS: INTEGRACIÓN del siguiente enlace: <br>
									<a style="color:#000" target="_blank" href="https://portal.todopago.com.ar/app/#crearBoton">https://portal.todopago.com.ar/app/#crearBoton</a>
								</p>
							</div>
							<?php
								$textoCabecera = ob_get_clean();
								$seccion = 'datosTodoPago';
								$titulo = 'Datos Todo Pago';
								$nombreOpcion = $modulo.'-'.$seccion;
								$tamanoImagen = '250px';

								ob_start();?>
								Activa el Ambiente de Pruebas para este metodo de pago. Podes Encontrar datos de prueba en el siguiente enlace: <a style="color:#000" target="_blank" href="https://developers.todopago.com.ar/site/datos-de-prueba">https://developers.todopago.com.ar/site/datos-de-prueba</a>
								<?php
								$DescripcionSandBox = ob_get_clean();

								$parametros = array(
									array(
										  'titulo' => 'Activar Todo Pago',
										  'nombre' =>'estado',
										  'tipo' => 'activacion',
										  'valueOn' => 'yes',
										  'valueOff'=>'no'
										  ),
									array(
										'titulo' => 'Nro. de Comercio (Merchant ID)',
										'nombre' =>'merchant_id_prod',
										'tipo' => 'input'
										),
									array(
										'titulo' => 'Credenciales (API Keys)',
										'nombre' =>'http_header_prod',
										'tipo' => 'input'
										),

									array(
										  'titulo' => 'Ambiente de Prueba',
										  'nombre' =>'sandbox',
										  'tipo' => 'activacion',
										  'valueOn' => 'test',
										  'valueOff'=>'prod',
										  'descripcion' => $DescripcionSandBox),
									array(
										'titulo' => 'Nro. de Comercio (Merchant ID) para Ambiente de Pruebas',
										'nombre' =>'merchant_id_test',
										'tipo' => 'input'
										),
									array(
										'titulo' => 'Credenciales (API Keys) para Ambiente de Pruebas',
										'nombre' => 'http_header_test',
										'tipo' => 'input',
										),
									);
								$subSecciones = array('unica');
								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen, $textoCabecera);
							?>
						</div>

						<!-- <div class="Conf panel-group">
							<?php
							$seccion = 'paginaGracias';
							$titulo = 'Mensaje de la pagina Gracias';
							$nombreOpcion = $modulo.'-'.$seccion;
							$subSecciones = array('unica');
							$tamanoImagen ='65px';

							ob_start();?>
							<div class="parametro">

								<p>Esta pagina se le muestra al usuario una vez ha culmindo el proceso de compra. Puedes intoducir codigo HTML cliqueando en la pestaña que se encuentra arriba a la derecha del editor que aparece debajo de estas lineas</p>
								<p>Ejemplo: </p>
								<textarea style="height: 120px"><h2>Felicitaciones. Has realizado tu compra.</h2>
								<p>Recibiras un email con todos los detalles de tu compra.</p>
								<a class="botonGeneral" href="http://cuerdoscloth.com/">continuar</a></textarea>


							</div>
							<?php
							$textoCabecera = ob_get_clean();

							$subSecNumeradas = false;
							$traducir = true;
							$parametros = array(
								array('nombre' => '', 'tipo' => 'wpEditor', 'traducir' => false),
								);
								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen, $textoCabecera, $subSecNumeradas, $traducir); ?>

						</div>

						<div class="Conf panel-group">
								<?php
									$seccion = 'ofertaMiniCarrito';
									$titulo = 'Oferta Mini Carrito';
									$nombreOpcion = $modulo.'-'.$seccion;
									$tamanoImagen = '250px';
									$parametros = array(
										array('nombre' => 'html', 'tipo' => 'wpEditor'),
										);
									$subSecciones = array('unica');

									ob_start();?>
									<div class="parametro">
										<p>Para intoducir codigo HTML clique en la pestaña que se encuentra arriba a la derecha del editor que aparece debajo de estas lineas</p>
										<p>El siguiente codigo es un ejemplo de contenido interactivo, el "numero_ID_del_producto" lo puede encontrar pasando el puntero sobre los productos en el siguiente enlace: <a href="<?php echo get_bloginfo('url')?>/autogestion/wp-admin/edit.php?post_type=product&paged=1">lista de productos</a></p>
										<textarea style="height: 240px"><div class="ofertaMiniCart">
											<div class="images">
												<a href="#"> <img title="titulo del producto" src="" alt="nombre alternativo a la imagen" /></a>
											</div>
											<div class="info">
												<a title="titulo del producto" href="#">
												</a>
												<h3>titulo del producto</h3>
												<a class="verMas" href="#">Ver Mas</a>
												<div class="single_add_to_cart_button button alt add_to_cart_button ajax_add_to_cart" data-product_id="numero_ID_del_producto" data-quantity="1">+ Agregar a carrito</div>
											</div>
										</div></textarea>
									</div>


									<?php
										$textoCabecera = ob_get_clean();

									cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen, $textoCabecera);
								?>
						</div> -->
					</div>



					<div class="block ui-tabs-panel <?php if ($opciones['moduloActivo'] === '#tabAdmin-avisosLegales') {echo 'active'; } else {echo 'deactive'; } ?> " id="option-tabAdmin-avisosLegales" >
						<?php $modulo = 'avisosLegales' ?>
						<div class="Conf panel-group">
							<?php
							$seccion = 'termYcond';
							$titulo = 'Terminos y condiciones';
							$nombreOpcion = $modulo.'-'.$seccion;
							$subSecciones = array('unica');
							$parametros = array(
								array('nombre' => '', 'tipo' => 'wpEditor'),
								);
								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen); ?>

						</div>
						<div class="Conf panel-group">
							<?php
							$seccion = 'legal';
							$titulo = 'Legal';
							$nombreOpcion = $modulo.'-'.$seccion;
							$subSecciones = array('unica');
							$parametros = array(
								array('nombre' => '', 'tipo' => 'wpEditor'),
								);
								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen); ?>

						</div>
						<div class="Conf panel-group">
							<?php
							$seccion = 'termPrivacidad';
							$titulo = 'Terminos de Privacidad';
							$nombreOpcion = $modulo.'-'.$seccion;
							$subSecciones = array('unica');
							$parametros = array(
								array('nombre' => '', 'tipo' => 'wpEditor'),
								);
								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen); ?>

						</div>
					</div>



					<?php $modulo = 'pieDePagina' ?>
					<div class="block ui-tabs-panel <?php if ($opciones['moduloActivo'] === '#tabAdmin-'.$modulo) {echo 'active'; } else {echo 'deactive'; } ?>" id="option-tabAdmin-<?php echo $modulo;?>" >

						<div class="Conf panel-group">
							<?php
							$seccion = 'logoFooter';
							$titulo = 'Logo secundario de Cuerdos';
							$nombreOpcion = $modulo.'-'.$seccion;
							$subSecciones = array('unica');
							$tamanoImagen ='350px';
							$parametros = array(
								array('nombre' => '', 'tipo' => 'imagen'),
								);
							cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen); ?>

						</div>

						<div class="Conf panel-group">
							<?php
							$seccion = 'logosInferiores';
							$titulo = 'Logos inferiores';
							$nombreOpcion = $modulo.'-'.$seccion;
								$tamanoImagen = '20%';
								$textoCabecera = '';
								$parametros = array(
									array('nombre' =>'logo', 'tipo' => 'imagen'),
									array('nombre' =>'link', 'tipo' => 'input'),

									);

								$traducir = '';
								$toggleData = '';
								$ordenable = 'ordenable';
								$subSecNumeradas = true;

								$subSecciones= array();

								if ($opcionesArray[$modulo][$seccion]){
									foreach ($opcionesArray[$modulo][$seccion] as $ID => $value) {
										array_push($subSecciones, $ID);
									}
								}
								else{
									$subSecciones = array('logo_inferior_1');
								}

								cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen, $textoCabecera, $subSecNumeradas, $traducir, $toggleData, $ordenable);
							?>

						</div>

					</div>

					<div class="block ui-tabs-panel <?php if ($opciones['moduloActivo'] === '#tabAdmin-codigoAnalitics') {echo 'active'; } else {echo 'deactive'; } ?> " id="option-tabAdmin-codigoAnalitics" >

						<div class="Conf panel-group" id="accordionL">


							<div class="section">
								<h2>Codigo Analitics</h2>

								<textarea cols="8" rows="8" id="codigoAnalitics" name="codigoAnalitics"><?php if($opciones['codigoAnalitics']!='') {echo $opciones['codigoAnalitics']; } ?></textarea>

							</div>


						</div>
					</div>

				</form>

			</div>
		</div>

	</div>
</div>