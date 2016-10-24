<?php

/**Includes required resources here**/
define('WL_TEMPLATE_DIR_URI', get_template_directory_uri());
define('WL_TEMPLATE_DIR', get_template_directory());
define('WL_TEMPLATE_DIR_CORE' , WL_TEMPLATE_DIR . '/core');

add_action('admin_menu', 'weblizar_admin_menu_pannel');

function weblizar_admin_menu_pannel() {
	$page = add_menu_page( 'Weblizar', 'Autogestión', 'edit_theme_options', 'weblizar', 'weblizar_option_panal_function' );
	add_action('admin_print_styles-'.$page, 'weblizar_admin_enqueue_script');

}

function weblizar_admin_enqueue_script() {

	// wp_enqueue_script('weblizar-tab-js', WL_TEMPLATE_DIR_URI .'/core/theme-options/js/option-js.js',array('media-upload', 'jquery-ui-sortable'));
	wp_enqueue_style('thickbox');
	wp_enqueue_style('dashicons');
	wp_enqueue_style('option-style', WL_TEMPLATE_DIR_URI .'/style.css');
}

function weblizar_option_panal_function() {
	require_once(WL_TEMPLATE_DIR_CORE.'/theme-options/option-data.php');
	require_once(WL_TEMPLATE_DIR_CORE.'/theme-options/option-settings.php');
}

/*function edit_editor_menus() {
	// 1. Seleccionamos el rol
	 // Añadimos capacidad con add_cap()
	//$role_object->add_cap( 'edit_theme_options');
	//$role_object = get_role( 'editor' );
	// Añadimos capacidad con add_cap()
	$role_object = get_role( 'shop_manager' );
	$role_object->add_cap( 'edit_theme_options');
}*/
function edit_editor_menus() {
	// le da perimisoso a los roles del array $roles para que puedan editar el tema

	$roles = array('editor', 'shop_manager');
	foreach ($roles as $rol) {
		$rol_objet = get_role( $rol );
		if (!is_null($rol_objet)) {
			$rol_objet->add_cap( 'edit_theme_options');
			$rol_objet->add_cap( 'manage_options');
			$rol_objet->add_cap( 'manage_network_plugins');
		}
	}


}
add_action( 'admin_menu', 'edit_editor_menus' );

function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');


//Sane Defaults
function opcionesPorDefecto(){

	$opcionesDelTema=array(
		/*si es necesario tener seteada info antes de llenarla este es el lugara para declarar es valor
		'clave' => 'valor'*/
		);
	return apply_filters( 'opcionesDelTema', $opcionesDelTema );
}

function obtenerOpcionesDelTema() {
	// Options API
	return wp_parse_args( get_option( 'opcionesDelTema', array() ), opcionesPorDefecto() );
}

add_option( 'opcionesArray' );
add_option( 'opcionesBackUp' );

$opciones = obtenerOpcionesDelTema();
$opcionesArray = get_option( 'opcionesArray' );

function opciones($opciones){


	$final = array();

	foreach ($opciones as $seccion => $valorSeccion) {
		$patron = explode('-',$seccion);
		$profundidad = count($patron);
		end($patron);
		$n = $valorSeccion;
		for ($i=1; $i <= $profundidad ; $i++) {
			$n = array( current($patron) => $n);
			prev($patron);
		}
		$final = array_merge_recursive($final,$n); //si esxiste la clave los mescla
	}
	return $final;
}


function cargaParametros($titulo, $nombreOpcion, $subSecciones, $parametros, $tamanoImagen, $textoCabecera = '', $subSecNumeradas = false, $traducir = false, $toggleData = '', $ordenable = '') {
	global $opciones;

	$toggleData = ($toggleData === '') ? $nombreOpcion : $toggleData;

	?>


	<div class="ConfToggleHead"  data-toggle="collapse" href="#<?php echo $toggleData?>">
		<h2><?php echo $titulo ?></h2>
	</div>
	<div class="section collapse ConfBody" id="<?php echo $toggleData;  ?>">

		<?php

		if ($textoCabecera !== '')
			echo $textoCabecera;

		$i = 1;
		foreach ($subSecciones as $key => $subSeccion):

			if ($subSeccion === 'unica') {
				$nombreSubseccion = '';
			} else{
				$nombreSubseccion = '-'.$subSeccion;
			}
			?>

			<div class="<?php if ($subSeccion !=='unica') echo 'celda section' ?> <?php echo $ordenable ?>" id="<?php if ($subSeccion !=='unica') echo $subSeccion; ?>" data-index="<?PHP echo $i ;?>">
				<?php
				$vowels = array("_");
				$SubTitulo = str_replace($vowels, " ", $subSeccion);

				if ($subSeccion !=='unica') {

					if ($subSecNumeradas){
						$TituloArray = explode(' ', $SubTitulo);

						array_pop($TituloArray);
						if (count($TituloArray) > 1)
							$baseTitulo = implode(" ", $TituloArray);
						else
							$baseTitulo = $TituloArray[0];

					}
					$tituloSubSec = (!$subSecNumeradas) ? ucfirst($SubTitulo) : ucfirst($baseTitulo).' '.$i;
					echo '<h2>'.$tituloSubSec.'</h2>';

				}
				?>

				<?php foreach ($parametros as $key => $parametro): ?>

					<div class="parametro parametro-<?php echo $parametro['tipo'] ?>">

						<?php
							if (key_exists('titulo', $parametro)) echo '<p>'.$parametro['titulo'].'</p>';
							else echo '<p>'.ucfirst(str_replace($vowels, " ",$parametro['nombre'])).'</p>';
						?>

						<?php if (key_exists('descripcion', $parametro)) echo '<p>'.$parametro['descripcion'].'</p>'; ?>

						<?php
						if ($parametro['nombre'] === '')
							$NombreDelParametro = '';
						else
							$NombreDelParametro = '-'.$parametro['nombre'];
						?>

						<?php if ($parametro['tipo'] === 'input'): ?>


							<input class="weblizar_inpute <?php if (key_exists('traducir', $parametro)) echo 'traducir'; ?> <?php if (key_exists('controlComas', $parametro)) echo 'AdminCostoEnvio'; ?>" type="text" name="<?php echo $nombreOpcion.$nombreSubseccion.$NombreDelParametro ?>" id="<?php echo $nombreOpcion.$nombreSubseccion.$NombreDelParametro ?>" value="<?php echo $opciones[$nombreOpcion.$nombreSubseccion.$NombreDelParametro]; ?>" >

						<?php endif; ?>
						<?php if ($parametro['tipo'] === 'textarea'): ?>


							<textarea class="weblizar_inpute <?php if (key_exists('traducir', $parametro)) echo 'traducir'; ?>" style="width:100%;" type="text" name="<?php echo $nombreOpcion.$nombreSubseccion.$NombreDelParametro ?>" id="<?php echo $nombreOpcion.$nombreSubseccion.$NombreDelParametro ?>"><?php echo $opciones[$nombreOpcion.$nombreSubseccion.$NombreDelParametro]; ?></textarea>

						<?php endif; ?>


						<?php if ($parametro['tipo'] === 'imagen'): ?>
							<input class="inputUrlImagen" type="text" value="<?php if (array_key_exists($nombreOpcion.$nombreSubseccion.$NombreDelParametro.'-img',$opciones)) echo $opciones[$nombreOpcion.$nombreSubseccion.$NombreDelParametro.'-img']; ?>" id="<?php echo $nombreOpcion.$nombreSubseccion.$NombreDelParametro ?>-img" name="<?php echo $nombreOpcion.$nombreSubseccion.$NombreDelParametro ?>-img" class="upload has-file"/>

							<input type="hidden" name="<?php echo $nombreOpcion.$nombreSubseccion.$NombreDelParametro ?>-id" value="<?php if (array_key_exists($nombreOpcion.$nombreSubseccion.$NombreDelParametro.'-id',$opciones)) echo $opciones[$nombreOpcion.$nombreSubseccion.$NombreDelParametro.'-id']; ?>">
							<div type="button"id="upload_button" class="upload_image_button" />Cambiar <?php echo $parametro['nombre'] ?></div>
							<img style="max-width:<?php echo $tamanoImagen ?>" src="<?php if (array_key_exists($nombreOpcion.$nombreSubseccion.$NombreDelParametro.'-img',$opciones)) echo $opciones[$nombreOpcion.$nombreSubseccion.$NombreDelParametro.'-img']; ?>"/>
							<?php if (key_exists('borrable',$parametro)): ?>
								<div class="borraImagen botonRojo">Borrar Imagen</div>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ($parametro['tipo'] === 'wpEditor'): ?>
							<div>
								<?php
								wp_editor(
									$opciones[$nombreOpcion.$nombreSubseccion.$NombreDelParametro],
									$nombreOpcion.$nombreSubseccion.$NombreDelParametro.'_wpEditor',
									$settings = array('textarea_name' => $nombreOpcion.$nombreSubseccion.$NombreDelParametro)
									);
									?>

							</div>
						<?php endif; ?>

						<?php if ($parametro['tipo'] === 'mapa'): ?>
							<input class="weblizar_inpute" type="text" name="<?php echo $nombreOpcion.$nombreSubseccion.$NombreDelParametro ?>" id="<?php echo $nombreOpcion.$nombreSubseccion.$NombreDelParametro ?>"value="<?php echo $opciones[$nombreOpcion.$nombreSubseccion.$NombreDelParametro]; ?>" >
							<input type="button" id="abreMapa-<?php echo $nombreOpcion.$nombreSubseccion.$NombreDelParametro ?>" data-idInput="#<?php echo $nombreOpcion.$nombreSubseccion.$NombreDelParametro ?>" value="Cambiar <?php echo $parametro['nombre'] ?>" class="abreMapa"/>

						<?php endif; ?>
						<?php if ($parametro['tipo'] === 'checkbox'):
							$nameChekbox = $nombreOpcion.$nombreSubseccion.$NombreDelParametro; ?>

							<?php $checked = (array_key_exists($nameChekbox, $opciones)) ? 'checked' : ''; ?>
							<div class="model-2">
							  <div class="checkbox">
							    <input class="weblizar_inpute" type="checkbox"value="<?php if (array_key_exists($nameChekbox, $opciones)) echo $opciones[$nameChekbox]?>" name="<?php echo $nameChekbox ?>" id="<?php echo $nameChekbox ?>" value="" <?php echo $checked; ?>>
							    <label></label>
							  </div>
							</div>
							<script>
								jQuery('#<?php echo $nameChekbox ?>').change(function(){
									$this = jQuery(this);
									if ($this.is(':checked')){
									    $this.val('si');
									    $this.attr('value','si');
									    if (jQuery('#auxBorrar').length);
									    	jQuery('#auxBorrar').remove();
									}
									else{
									    $this.after('<input id="auxBorrar" type="hidden" name="<?php echo $nameChekbox ?>" value="">');
									}

								});

							</script>

						<?php endif; ?>
						<?php if ($parametro['tipo'] === 'activacion'):
							$nameActivacion = $nombreOpcion.$nombreSubseccion.$NombreDelParametro;

							$valueOn = (key_exists('valueOn', $parametro)) ? $parametro['valueOn'] : 1;
							$valueOff = (key_exists('valueOff', $parametro)) ? $parametro['valueOff'] : 0;
						?>


							<input type="radio" name="<?php echo $nameActivacion ?>" value="<?php echo $valueOn ?>"id="<?php echo $nameActivacion.'-'.$valueOn; ?>"<?php if ($opciones[$nameActivacion] === $valueOn) echo 'checked'; ?>>
							<label for="<?php echo $nameActivacion.'-'.$valueOn; ?>">Si</label>

							<input type="radio" name="<?php echo $nameActivacion ?>" value="<?php echo $valueOff ?>" id="<?php echo $nameActivacion.'-'.$valueOff; ?>" <?php if (!key_exists($nameActivacion, $opciones) || $opciones[$nameActivacion] === $valueOff) echo 'checked'; ?>>
							<label for="<?php echo $nameActivacion.'-'.$valueOff; ?>">No</label>

						<?php endif; ?>

					</div>


				<?php endforeach; ?>
				<?php if ($subSecNumeradas): ?>
					<div class="eliminar_image_button">Eliminar</div>
				<?php endif;?>
				</div>
				<?php $i++ ?>
		<?php endforeach; ?>

			<?php if ($subSecNumeradas): ?>

				<?php $nombreBaseArray = explode('_', $subSeccion);
					  array_pop($nombreBaseArray);
					  $nombreBase = implode('_', $nombreBaseArray);
				?>
				<?php $subSeccionSinNumero = $nombreBase.'_HHH';  ?>

				<div class="celda section modeloClon <?php echo $ordenable ?>" id="<?php echo $subSeccionSinNumero ?>">
					<?php
					$vowels = array("_");
					$SubTitulo = str_replace($vowels, " ", $subSeccionSinNumero);

					echo '<h2>'.ucfirst($SubTitulo).'</h2>' ?>

					<?php foreach ($parametros as $key => $parametro): ?>

						<div class="parametro <?php if ($parametro['tipo'] === 'imagen') echo 'parametro_imagen' ;?>">


								<?php
								if (key_exists('titulo', $parametro)) echo '<p>'.$parametro['titulo'].'</p>';
								else echo '<p>'.ucfirst(str_replace($vowels, " ",$parametro['nombre'])).'</p>';
							?>


							<?php
							if ($parametro['nombre'] === '')
								$NombreDelParametro = '';
							else
								$NombreDelParametro = '-'.$parametro['nombre'];
							?>

							<?php if ($parametro['tipo'] === 'input'): ?>


								<input class="weblizar_inpute <?php if (key_exists('traducir', $parametro)) echo 'traducir'; ?> <?php if (key_exists('controlComas', $parametro)) echo 'AdminCostoEnvio'; ?>" type="text" name="<?php echo $nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro ?>" id="<?php echo $nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro ?>" value="" >

							<?php endif; ?>
							<?php if ($parametro['tipo'] === 'textarea'): ?>


								<textarea class="weblizar_inpute <?php if (key_exists('traducir', $parametro)) echo 'traducir'; ?>" style="width:100%;" type="text" name="<?php echo $nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro ?>" id="<?php echo $nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro ?>"><?php echo $opciones[$nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro]; ?></textarea>

							<?php endif; ?>

							<?php if ($parametro['tipo'] === 'imagen'): ?>
								<input class="inputUrlImagen" type="text" value="" id="<?php echo $nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro ?>-img" name="<?php echo $nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro ?>-img" class="upload has-file"/>
								<input type="hidden" name="<?php echo $nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro ?>-id" value="">

								<img style="max-width:<?php echo $tamanoImagen ?>" src=""/>

								<?php if (key_exists('borrable',$parametro)): ?>
									<div class="borraImagen botonRojo">Borrar Imagen</div>
								<?php endif; ?>

							<?php endif; ?>

							<?php if ($parametro['tipo'] === 'wpEditor'): ?>

								<?php
								wp_editor(
									'',
									$nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro,
									$settings = array('textarea_name' => $nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro)
									);
									?>



							<?php endif; ?>
							<?php if ($parametro['tipo'] === 'mapa'): ?>
								<input class="weblizar_inpute" type="text" name="<?php echo $nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro ?>" id="<?php echo $nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro ?>" value="" >
								<input type="button" id="abreMapa-<?php echo $nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro ?>" data-idInput="#<?php echo $nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro ?>" value="Cambiar <?php echo $parametro['nombre'] ?>" class="abreMapa"/>

							<?php endif ?>



							<?php if ($parametro['tipo'] === 'checkbox'):
								$nameChekbox = $nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro; ?>

								<?php $checked = (array_key_exists($nameChekbox, $opciones)) ? 'checked' : ''; ?>
								<div class="model-2">
								  <div class="checkbox">
								    <input class="weblizar_inpute" type="checkbox"value="<?php if (array_key_exists($nameChekbox, $opciones)) echo $opciones[$nameChekbox]?>" name="<?php echo $nameChekbox ?>" id="<?php echo $nameChekbox ?>" value="" <?php echo $checked; ?>>
								    <label></label>
								  </div>
								</div>
								<script>
									jQuery('#<?php echo $nameChekbox ?>').change(function(){
										$this = jQuery(this);
										if ($this.is(':checked')){
										    $this.val('si');
										    $this.attr('value','si');
										    if (jQuery('#auxBorrar').length);
										    	jQuery('#auxBorrar').remove();
										}
										else{
										    $this.after('<input id="auxBorrar" type="hidden" name="<?php echo $nameChekbox ?>" value="">');
										}

									});

								</script>

							<?php endif; ?>
							<?php if ($parametro['tipo'] === 'activacion'):
								$nameActivacion = $nombreOpcion.'-'.$subSeccionSinNumero.$NombreDelParametro;

								$valueOn = (key_exists('valueOn', $parametro)) ? $parametro['valueOn'] : 1;
								$valueOff = (key_exists('valueOff', $parametro)) ? $parametro['valueOff'] : 0;
							?>

								<input type="radio" name="<?php echo $nameActivacion ?>" value="<?php echo $valueOn ?>" id="<?php echo $nameActivacion.'-'.$valueOn; ?>" <?php if ($opciones[$nameActivacion] === $valueOn) echo 'checked'; ?>>
								<label for="<?php echo $nameActivacion.'-'.$valueOn ?>">Si</label>

								<input type="radio" name="<?php echo $nameActivacion ?>" value="<?php echo $valueOff ?>" id="<?php echo $nameActivacion.'-'.$valueOff; ?>" <?php if (!key_exists($nameActivacion, $opciones) || $opciones[$nameActivacion] === $valueOff) echo 'checked'; ?>>
								<label for="<?php echo $nameActivacion.'-'.$valueOff ?>">No</label>

							<?php endif; ?>


						</div>

					<?php endforeach; ?>

				</div>

				<span class="agregarNuevoCONPARAMETROS">Agregar Nuevo</span>
			<?PHP endif; ?>




		</div>

<?php
}



function cargarSlide($titulo, $nombreOpcion, $arrayOpciones, $conCaption = true, $link = '') { ?>

	<div class="Conf panel-group" id="acordion-<?php echo $nombreOpcion ?>	">

		<div class="ConfToggleHead"  data-toggle="collapse" data-parent="#acordion-<?php echo $nombreOpcion ?>" href="#<?php echo $nombreOpcion?>">

			<h2><?php echo $titulo?></h2>
		</div>

		<div id="<?php echo $nombreOpcion?>" class="collapse ConfBody">


			<?php
			$i =1;
			if (!empty($arrayOpciones)){
				foreach ($arrayOpciones as $ID => $valor ) : ?>


				<div class="section celda col3 ordenable" id="<?php echo $ID ?>" data-i="<?php echo $i;?>">

					<h2>Slide <?php echo $i ?></h2>
					<input type="hidden" name="<?php echo $nombreOpcion.'-'.$ID.'-id';?>" value="<?php if (array_key_exists('id',$valor)) echo $valor['id'] ?>" />
					<input class="inputUrlImagen" type="text" value="<?php echo $valor['img'];?>" id="<?php echo $ID;?>" name="<?php echo $nombreOpcion.'-'.$ID.'-img';?>"/>
					<input type="button" id="upload_button<?php echo $i;?>" value="Cambiar Slide <?php echo $i;?>" class="upload_image_button" />


					<?php if ($conCaption): ?>

						<div>
							<label for="">Titulo: </label>

							<input type="text" class="traducir" value="<?php if (array_key_exists('titulo',$valor)) echo $valor['titulo'];?>" id="<?php echo $nombreOpcion.'-'.$ID.'-titulo';?>" name="<?php echo $nombreOpcion.'-'.$ID.'-titulo';?>"/>

							<label for="">Descripcion: </label>
							<input type="text" class="traducir" value="<?php  if (array_key_exists('descripcion',$valor)) echo $valor['descripcion'];?>" id="<?php echo $nombreOpcion.'-'.$ID.'-descripcion';?>" name="<?php echo $nombreOpcion.'-'.$ID.'-descripcion';?>"/>
						</div>

					<?php endif; ?>

					<?php if ($link !== ''): ?>

						<div>

							<label for="">Link del slide: </label>
							<input placeholder="Link del slide" type="text" value="<?php if (array_key_exists('link',$valor)) echo $valor['link'];?>" id="<?php echo $ID;?>" name="<?php echo $nombreOpcion.'-'.$ID.'-link';?>"/>
						</div>

					<?php endif; ?>

					<img style="max-width:100%;" src="<?php if (array_key_exists('img',$valor)) echo $valor['img'];?>" />

					<input type="button" id="upload_button<?php echo $i;?>" value="Eliminar" class="eliminar_image_button" />
				</div>

				<?php
				$i++;

				endforeach;

			}; ?>
			<span class="agregarNuevo">+ Agregar Slide</span>

		</div>
	</div>
	<?php

}

add_action('admin_footer', 'linkmanejadorAdminDOM');

function linkmanejadorAdminDOM() {
	?>
	<script src="<?php echo get_bloginfo('template_url');?>/js/manejadorAdminDOM.js"></script>
	<script src="<?php echo get_bloginfo('template_url')?>/core/theme-options/js/option-js.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?libraries=places&key=AIzaSyBVfj9ocjSwJpiy6PwTEDLVrU7X2U38MrA"></script>


	<?php if (!esPerfil('administrator')){ ?>
		<script>jQuery('.woocommerce-message').css({'display':'none'});</script>
	<?php } ?>

	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url');?>/css/manejadorAdminDOM.css">
	<link id="themeURL" data-themeURL="<?php echo get_bloginfo('template_url')?>/" rel="stylesheet" href="">

	<?php
}

add_action( 'after_setup_theme', 'my_theme_setup' );
function my_theme_setup(){
	load_theme_textdomain('sistema', get_template_directory() . '/idiomas');
}


remove_all_filters( 'get_term');
remove_all_filters( 'get_terms');

add_filter('get_term', 'traducirEditPhp', 99, 2);
add_filter('get_terms', 'traducirEditPhp', 99, 3);

function traducirEditPhp($obj, $taxonomies=null, $args=null) {
	global $pagenow;

	switch($pagenow){
		case 'nav-menus.php':
		case 'edit-tags.php':
		case 'edit.php':
		return qtranxf_useTermLib($obj);
		default: return qtranxf_useTermLib($obj);
	}
}

function website_name(){
	$site_name = get_bloginfo('name');
	return $site_name;
}

//add_filter('wp_mail_from','website_email');
add_filter('wp_mail_from_name','website_name');

?>