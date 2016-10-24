<?php
// el if verifica que este archivo option-data.php sea ejecutado optiona-settings.php que postea 'moduloActivo'
if (isset($_POST['moduloActivo'])) {
	global $opciones;

	update_option('opcionesBackUp', $opciones);

	$arrayAUX = array();

	/*foreach($_POST as  $key => $value){

		if ($value != 'eliminarCampo' ) {
			$opciones[$key] = $_POST[$key];

		} else{
			unset($opciones[$key]);

		}
	}

	foreach($opciones as  $key => $value){

		if ($value === '' ){
			unset($opciones[$key]);
			$partes = explode('-', $key);
			if (end($partes) === 'img')  {
				array_pop($partes);
				$id = implode("-", $partes).'-id';
				unset($opciones[$id]);
			}
		}

	}
*/
	foreach($_POST as  $key => $value){
		if ( $value !== '' && strpos($value, 'eliminarCampo') === false) {
			$arrayAUX[$key] = $_POST[$key];
		}
	}

	$opciones = $arrayAUX;

	update_option('opcionesDelTema', stripslashes_deep($opciones));
	update_option('opcionesArray', opciones($opciones));

	do_action( 'alGrabarOpciones', $opciones );
}


?>