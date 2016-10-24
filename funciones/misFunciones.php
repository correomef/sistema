<?php

function esPerfil($perfil) {
	$user = wp_get_current_user();
	if ( in_array( $perfil, (array) $user->roles ) )
		$esPerfil = true;
	else
		$esPerfil = false;
	return $esPerfil;
}


function idioma($en ='', $es ='', $pt ='', $de ='', $noEcho =''){


	if (!empty($noEcho)) {

		switch (get_bloginfo('language')) {
			case 'en-US':
				if ($en !== '')
					return $en;
				else
					return $es;
				break;
			case 'es-ES':
				return $es;
				break;
			case 'pt-PT':
				if ($pt !== '')
					return $pt;
				else
					return $es;
				break;
			case 'de-DE':
				if ($de !== '')
					return $de;
				else
					return $es;
				break;

			default:
				return $es;
				break;
		}

	} else {

		switch (get_bloginfo('language')) {
			case 'en-US':
				if ($en !== '')
					echo $en;
				else
					echo $es;
				break;
			case 'es-ES':
				echo $es;
				break;
			case 'pt-PT':
				if ($pt !== '')
					echo $pt;
				else
					echo $es;
				break;
			case 'de-DE':
				if ($de !== '')
					echo $de;
				else
					echo $es;
				break;
			default:
				echo $es;
				break;
		}

	}
}

function pesoFile($src){
	$peso = (empty($src)) ? 0 : get_headers($src, 1)["Content-Length"] ;
	//$img = get_headers($src, 1);
	return $peso;
}

/*imprimo lista en pantalla con formato para el metabox*/
function textareaOpcionesMetabox($texarea){

	$arreglo = explode("\n", $texarea);

	foreach ($arreglo as $key => $value) {
		$value = rtrim($value);

		$arr[$value]= $value;
	}


	return $arr;
}

function resumen($texto, $cantCaracteres=85, $porPalabla = true, $final = ' ...') {

	//$texto = strip_shortcodes($texto);
	$texto = strip_tags($texto);

	//elimina tabs
	$texto = trim(preg_replace('/\t+/', '', $texto));

	//cuenta caracteres especiales
	$i = 0;
	$count = 0;
	$len = mb_strlen (mb_substr($texto, 0, $cantCaracteres));

	while ($i < $len) {
		$chr = ord ($texto[$i]);
		$i++;
		if ($i >= $len)
			break;
		if ($chr & 0x80)
		{
			$chr <<= 1;
			while ($chr & 0x80)
			{
				$count++;
				$i++;
				$chr <<= 1;
			}
		}
	}

	$asentos = $count/2;
	$Nfinal = mb_strlen($final);
	$nuevoLargo = $cantCaracteres + $asentos - $Nfinal;


	$the_str = mb_substr($texto, 0, $nuevoLargo);

	// saca ultima palabra posiblemente recortada
	if ($porPalabla){
		if (mb_strlen($texto) > $nuevoLargo) {
			$arr = explode(' ',$the_str);
			array_pop($arr);
			$the_str = implode(' ',$arr);

			return $the_str.$final;

		}else {
			return $the_str;
		}
	}else{
		if (mb_strlen($texto) > $nuevoLargo) {
			return $the_str.$final;
		}else{
			return $the_str;
		}
	}

}

function textareaEntreEtiquetas($texarea, $etiqueta = '', $clasePasada = '', $valueEtiqueta = ''){

	$lista = '';

	$arreglo = explode("\n", $texarea);

	if ($clasePasada !== '') {
		$clase = ' class="'.$clasePasada.'"';
	}

	if ($etiqueta !== '') {
		foreach ($arreglo as $key => $value) {

			$value = rtrim($value);

			if ($valueEtiqueta !== '')
				$valueEtiqueta = 'value="'.$value.'"';

			$lista.= '<'.$etiqueta.$clase.$valueEtiqueta.'>'.$value.'</'.$etiqueta.'>';
		}
	}

	return $lista;
}

function textareaEntreTexto($texarea, $texto1 = '', $texto2 = ''){

	$arreglo = explode("\n", $texarea);
	$lista = '';

	if ($texto1 !== '' || $texto2 !== '' ) {

		if ($texto1 === ' ')
			$texto1 = '';

		if ($texto2 === ' ')
			$texto2 = '';

		foreach ($arreglo as $key => $value) {
			$lista.= $texto1 . $value . $texto2;
		}
	}
	else{

		foreach ($arreglo as $key => $value) {
			$lista.= $value;
		}
	}

	return $lista;
}

function turito($a, $b) {
    return strcmp($b['variation_id'], $a['variation_id']);
}

function comparaPorFecha($a, $b) {
	return strcmp($b->post_modified, $a->post_modified);
}

function cmp($a, $b) {
    return strcmp($a->parent, $b->parent);
}

function comparaVid($a, $b) {
    return strcmp($b['variation_id'], $a['variation_id']);
}

?>